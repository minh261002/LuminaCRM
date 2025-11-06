<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Support\Facades\Crypt;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Show the 2FA setup page
     */
    public function index()
    {
        $user = Auth::user();
        $breadcrumbs = [
            ['name' => 'Bảng điều khiển', 'url' => route('dashboard')],
            ['name' => 'Xác thực 2 lớp']
        ];

        // If already enabled, show status page
        if ($user->hasTwoFactorEnabled()) {
            return view('two-factor.status', compact('breadcrumbs', 'user'));
        }

        // Generate new secret if not exists
        if (!$user->two_factor_secret) {
            $user->two_factor_secret = encrypt($this->google2fa->generateSecretKey());
            $user->save();
        }

        $secret = decrypt($user->two_factor_secret);

        try {
            $qrCodeData = $this->google2fa->getQRCodeInline(
                config('app.name', 'Lumina'),
                $user->email,
                $secret,
                200
            );

            if (str_contains($qrCodeData, '%20') || str_contains($qrCodeData, '%3C')) {
                $qrCodeData = urldecode($qrCodeData);
            }

            if (str_starts_with($qrCodeData, '<?xml') || str_starts_with($qrCodeData, '<svg')) {
                $qrCodeInline = 'data:image/svg+xml;base64,' . base64_encode($qrCodeData);
            } elseif (!str_starts_with($qrCodeData, 'data:')) {
                $qrCodeInline = 'data:image/svg+xml;base64,' . base64_encode($qrCodeData);
            } else {
                $qrCodeInline = $qrCodeData;
            }
        } catch (\Exception $e) {
            Log::error('2FA QR Code generation error: ' . $e->getMessage());
            $qrCodeInline = null;
        }

        return view('two-factor.setup', compact('breadcrumbs', 'user', 'qrCodeInline', 'secret'));
    }

    /**
     * Verify and enable 2FA
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6']
        ], [
            'code.required' => 'Mã xác thực là bắt buộc',
            'code.size' => 'Mã xác thực phải có 6 chữ số'
        ]);

        $user = Auth::user();
        $secret = decrypt($user->two_factor_secret);

        $valid = $this->google2fa->verifyKey($secret, $request->code, 2); // 2 = 60 seconds tolerance

        if (!$valid) {
            notyf()->error('Mã xác thực không hợp lệ. Vui lòng thử lại.');
            return back()->withInput();
        }

        // Generate recovery codes
        $recoveryCodes = $this->generateRecoveryCodes();
        $user->two_factor_recovery_codes = encrypt(json_encode($recoveryCodes));
        $user->two_factor_confirmed_at = now();
        $user->save();

        session()->flash('recovery_codes', $recoveryCodes);

        notyf()->success('Xác thực 2 lớp đã được kích hoạt thành công!');
        return redirect()->route('two-factor.recovery');
    }

    /**
     * Show recovery codes
     */
    public function recovery()
    {
        $breadcrumbs = [
            ['name' => 'Bảng điều khiển', 'url' => route('dashboard')],
            ['name' => 'Mã khôi phục']
        ];

        $recoveryCodes = session()->get('recovery_codes');

        if (!$recoveryCodes) {
            return redirect()->route('two-factor.index');
        }

        return view('two-factor.recovery', compact('breadcrumbs', 'recoveryCodes'));
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string']
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            notyf()->error('Mật khẩu không chính xác');
            return back();
        }

        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        notyf()->success('Xác thực 2 lớp đã được tắt');
        return redirect()->route('two-factor.index');
    }

    /**
     * Show recovery codes (for users who already have 2FA enabled)
     */
    public function showRecoveryCodes()
    {
        $user = Auth::user();

        if (!$user->hasTwoFactorEnabled()) {
            return redirect()->route('two-factor.index');
        }

        $breadcrumbs = [
            ['name' => 'Bảng điều khiển', 'url' => route('dashboard')],
            ['name' => 'Mã khôi phục']
        ];

        $recoveryCodes = $user->two_factor_recovery_codes
            ? json_decode(decrypt($user->two_factor_recovery_codes), true)
            : [];

        return view('two-factor.show-recovery', compact('breadcrumbs', 'recoveryCodes'));
    }

    /**
     * Regenerate recovery codes
     */
    public function regenerateRecoveryCodes(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string']
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            notyf()->error('Mật khẩu không chính xác');
            return back();
        }

        $recoveryCodes = $this->generateRecoveryCodes();
        $user->two_factor_recovery_codes = encrypt(json_encode($recoveryCodes));
        $user->save();

        session()->flash('recovery_codes', $recoveryCodes);

        notyf()->success('Mã khôi phục đã được tạo mới');
        return redirect()->route('two-factor.recovery');
    }

    /**
     * Generate recovery codes
     */
    protected function generateRecoveryCodes(): array
    {
        return Collection::times(8, function () {
            return strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8));
        })->all();
    }
    }
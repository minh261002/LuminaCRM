<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');
        $redirectUrl = $request->input('redirect_url');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout();
                notyf()->error('Tài khoản của bạn đã bị khóa');
                return back()->onlyInput('email');
            }

            // Check if 2FA is enabled
            if ($user->hasTwoFactorEnabled()) {
                // Store user ID in session for 2FA verification
                $request->session()->put('login.id', $user->id);
                $request->session()->put('login.remember', $remember);
                $request->session()->put('login.redirect_url', $redirectUrl);

                Auth::logout();

                return redirect()->route('two-factor.login');
            }

            $request->session()->regenerate();

            notyf()->success('Đăng nhập thành công');
            return redirect()->intended($redirectUrl ?? route('dashboard'));
        }

        notyf()->error('Thông tin đăng nhập không chính xác');
        return back()->onlyInput('email');
    }

    /**
     * Show 2FA login form
     */
    public function showTwoFactorLogin()
    {
        if (!session()->has('login.id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-login');
    }

    /**
     * Verify 2FA code during login
     */
    public function verifyTwoFactorLogin(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6']
        ], [
            'code.required' => 'Mã xác thực là bắt buộc',
            'code.size' => 'Mã xác thực phải có 6 chữ số'
        ]);

        if (!session()->has('login.id')) {
            return redirect()->route('login');
        }

        $userId = session()->get('login.id');
        $user = \App\Models\User::find($userId);

        if (!$user || !$user->hasTwoFactorEnabled()) {
            session()->forget(['login.id', 'login.remember', 'login.redirect_url']);
            return redirect()->route('login');
        }

        $secret = decrypt($user->two_factor_secret);
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->code, 2); // 2 = 60 seconds tolerance

        if (!$valid) {
            $recoveryCodes = $user->two_factor_recovery_codes
                ? json_decode(decrypt($user->two_factor_recovery_codes), true)
                : [];

            if (in_array(strtoupper($request->code), $recoveryCodes)) {
                $recoveryCodes = array_values(array_diff($recoveryCodes, [strtoupper($request->code)]));
                $user->two_factor_recovery_codes = encrypt(json_encode($recoveryCodes));
                $user->save();
                $valid = true;
            }
        }

        if (!$valid) {
            notyf()->error('Mã xác thực không hợp lệ');
            return back()->withInput();
        }

        Auth::login($user, session()->get('login.remember'));
        $redirectUrl = session()->get('login.redirect_url');

        session()->forget(['login.id', 'login.remember', 'login.redirect_url']);
        $request->session()->regenerate();

        notyf()->success('Đăng nhập thành công');
        return redirect()->intended($redirectUrl ?? route('dashboard'));
    }


    public function logout(Request $request){
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        notyf()->success('Đăng xuất thành công');
        return redirect()->route('login');
    }

    public function forgotPassword(){
        return view('auth.password.forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required','email']
        ],[
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
        ]);

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            $request->only('email')
        );

        if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            notyf()->success('Liên kết đặt lại mật khẩu đã được gửi.');
            return back()->with(['status' => __($status)]);
        }

        notyf()->error('Không thể gửi liên kết đặt lại mật khẩu.');
        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, string $token)
    {
        return view('auth.password.reset', [
            'token' => $token,
            'email' => $request->query('email')
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required','email'],
            'password' => ['required','confirmed','min:6']
        ], [
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'token.required' => 'Token là bắt buộc',
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => \Illuminate\Support\Facades\Hash::make($password),
                    'remember_token' => \Illuminate\Support\Str::random(60),
                ])->save();
            }
        );

        if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
            notyf()->success('Đặt lại mật khẩu thành công. Vui lòng đăng nhập.');
            return redirect()->route('login');
        }

        notyf()->error('Đặt lại mật khẩu thất bại.');
        return back()->withErrors(['email' => [__($status)]]);
    }
}
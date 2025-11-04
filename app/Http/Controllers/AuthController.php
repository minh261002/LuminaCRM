<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->route('dashboard');
        }

        notyf()->error('Thông tin đăng nhập không chính xác');

        return back()->onlyInput('email');
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

    // lock screen feature removed
}
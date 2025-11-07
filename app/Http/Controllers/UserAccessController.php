<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccessController extends Controller
{
    public function index(){
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Thông tin cá nhân']];
        return view('profile.index', compact('breadcrumbs') );
    }

    public function changePassword  (){
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Đổi mật khẩu']];
        return view('profile.change-password', compact('breadcrumbs') );
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $data = $request->validated();
        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)) {
            notyf()->error('Mật khẩu hiện tại không khớp');
            return redirect()->back();
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        notyf()->success('Mật khẩu đã được cập nhật thành công');
        return redirect()->back();
    }
}

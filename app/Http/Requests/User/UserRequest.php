<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'role_id' => 'required|exists:roles,name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|unique:users,phone',
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable',
            'avatar' => 'nullable|max:2048',
            'identity_type' => 'nullable',
            'identity_number' => 'nullable',
            'identity_issued_at' => 'nullable',
            'identity_issued_by' => 'nullable',
            'identity_front_image' => 'nullable',
            'identity_back_image' => 'nullable',
            'identity_selfie_image' => 'nullable',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required',
            'role_id' => 'required|exists:roles,name',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => 'nullable|unique:users,phone,'.$this->id,
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable',
            'avatar' => 'nullable|max:2048',
            'identity_type' => 'nullable',
            'identity_number' => 'nullable',
            'identity_issued_at' => 'nullable',
            'identity_issued_by' => 'nullable',
            'identity_front_image' => 'nullable',
            'identity_back_image' => 'nullable',
            'identity_selfie_image' => 'nullable',
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'role_id.required' => 'Vai trò không được để trống.',
            'role_id.exists' => 'Vai trò không hợp lệ.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone.unique' => 'Số điện thoại đã được sử dụng.',
            'avatar.image' => 'Ảnh đại diện phải là định dạng ảnh.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống.',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }
}

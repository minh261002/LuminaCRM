<?php

namespace App\Http\Requests\PaymentMethod;

use App\Http\Requests\BaseRequest;

class PaymentMethodRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'icon' => 'required',
            'description' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required|exists:payment_methods,id',
            'name' => 'required',
            'icon' => 'nullable',
            'description' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phương thức thanh toán không được để trống.',
            'icon.required' => 'Biểu tượng phương thức thanh toán không được để trống.',
            'description.required' => 'Mô tả phương thức thanh toán không được để trống.',
            'is_active.required' => 'Trạng thái phương thức thanh toán không được để trống.',
        ];
    }
}

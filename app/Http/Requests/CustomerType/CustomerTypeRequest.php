<?php

namespace App\Http\Requests\CustomerType;

use App\Http\Requests\BaseRequest;

class CustomerTypeRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:customer_types,code',
            'description' => 'nullable',
            'discount_percentage' => 'nullable',
            'credit_days' => 'required',
            'priority_level' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required',
            'name' => 'required',
            'code' => 'required|unique:customer_types,code,'.$this->id,
            'description' => 'nullable',
            'discount_percentage' => 'nullable',
            'credit_days' => 'required',
            'priority_level' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phân khúc khách hàng là bắt buộc.',
            'code.required' => 'Mã phân khúc khách hàng là bắt buộc.',
            'code.unique' => 'Mã phân khúc khách hàng đã tồn tại. Vui lòng sử dụng mã khác.',
            'credit_days.required' => 'Số ngày tín dụng là bắt buộc.',
        ];
    }
}

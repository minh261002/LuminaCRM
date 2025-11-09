<?php

namespace App\Http\Requests\CustomerRegion;

use App\Http\Requests\BaseRequest;

class CustomerRegionRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:customer_types,code',
            'description' => 'nullable',
            'parent_region_id' => 'nullable',
            'is_active' => 'nullable',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required',
            'parent_region_id' => 'nullable',
            'name' => 'required',
            'code' => 'required|unique:customer_types,code,'.$this->id,
            'description' => 'nullable',
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

<?php

namespace App\Http\Requests\BranchDelivery;

use App\Http\Requests\BaseRequest;

class BranchDeliveryRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:branch_deliveries,code',
            'is_active' => 'nullable',
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
        ];
    }

    protected function methodPut()
    {
        $branchId = $this->route('branch');

        return [
            'id' => 'required',
            'name' => 'required',
            'code' => 'required|unique:branch_deliveries,code,'.$this->id,
            'is_active' => 'nullable',
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên địa điểm không được để trống.',
            'code.required' => 'Mã địa điểm không được để trống.',
            'code.unique' => 'Mã địa điểm đã tồn tại.',
            'is_active.required' => 'Trạng thái địa điểm không được để trống.',
        ];
    }
}

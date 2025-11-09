<?php

namespace App\Http\Requests\Warehouse;

use App\Http\Requests\BaseRequest;

class WarehouseRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required',
            'code' => 'required|unique:warehouses,code',
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
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required',
            'code' => 'required|unique:warehouses,code,'.$this->id,
            'is_active' => 'nullable',
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Chi nhánh không được để trống.',
            'branch_id.exists' => 'Chi nhánh không tồn tại trong hệ thống.',
            'name.required' => 'Tên kho hàng không được để trống.',
            'code.required' => 'Mã kho hàng không được để trống.',
            'code.unique' => 'Mã kho hàng đã tồn tại.',
            'is_active.required' => 'Trạng thái kho hàng không được để trống.',
        ];
    }
}

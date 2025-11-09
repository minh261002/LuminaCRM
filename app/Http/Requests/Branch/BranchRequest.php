<?php

namespace App\Http\Requests\Branch;

use App\Http\Requests\BaseRequest;

class BranchRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'code' => 'required|unique:branches,code',
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
            'code' => 'required|unique:branches,code,'.$this->id,
            'is_active' => 'nullable',
            'province_code' => 'nullable',
            'ward_code' => 'nullable',
            'address' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chi nhánh không được để trống.',
            'code.required' => 'Mã chi nhánh không được để trống.',
            'code.unique' => 'Mã chi nhánh đã tồn tại.',
            'is_active.required' => 'Trạng thái chi nhánh không được để trống.',
        ];
    }
}

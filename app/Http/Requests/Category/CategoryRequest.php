<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;

class CategoryRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'name' => 'required',
            'image' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required|exists:categories,id',
            'name' => 'required',
            'image' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID danh mục không được để trống.',
            'id.exists' => 'ID danh mục không tồn tại.',
            'name.required' => 'Tên danh mục không được để trống.',
            'image.image' => 'Hình ảnh không hợp lệ.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'parent_id.exists' => 'Danh mục cha không tồn tại.',
        ];
    }
}

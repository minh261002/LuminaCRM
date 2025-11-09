<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class CategoryService implements CategoryServiceInterface
{
    use ImageUploadTrait;

    protected $data;

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['image'] = $this->uploadImage($request->file('image'), 'images/categories');

        if (! isset($this->data['is_active'])) {
            $this->data['is_active'] = 0;
        } else {
            $this->data['is_active'] = 1;
        }

        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        $id = $this->data['id'];

        if (! isset($this->data['is_active'])) {
            $this->data['is_active'] = 0;
        } else {
            $this->data['is_active'] = 1;
        }

        $category = $this->repository->find($id);

        if ($file = $request->file('image')) {
            $this->data['image'] = $this->replaceImage($category->image, $file, 'images/categories');
        } elseif ($request->filled('image_remove')) {
            $this->deleteImage($request->input('image_remove'));
            $this->data['image'] = null;
        } else {
            unset($this->data['image']);
        }

        return $this->repository->update($id, $this->data);
    }
}

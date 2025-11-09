<?php

namespace App\Http\Controllers;

use App\DataTables\Category\CategoryDataTable;
use App\Http\Requests\Category\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Category\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(
        CategoryRepositoryInterface $repository,
        CategoryServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(CategoryDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý danh mục sản phẩm']];

        return $dataTable->render('category.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý danh mục sản phẩm']];
        $categories = $this->repository->getFlatTree();

        return view('category.create', compact('breadcrumbs', 'categories'));
    }

    public function store(CategoryRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm danh mục mới thành công.');
        } else {
            notyf()->error('Thêm danh mục mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý danh mục sản phẩm']];
        $category = $this->repository->find($id);
        $categories = $this->repository->getFlatTree();

        view()->share('model', $category);

        return view('category.edit', compact('breadcrumbs', 'category', 'categories'));
    }

    public function update(CategoryRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin danh mục thành công.');
        } else {
            notyf()->error('Cập nhật thông tin danh mục thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('categories.index');
    }

    public function active($id)
    {
        $category = $this->repository->find($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return response()->json(['success' => true]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin danh mục thành công ']);
    }
}

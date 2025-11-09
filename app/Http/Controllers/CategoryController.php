<?php

namespace App\Http\Controllers;

use App\DataTables\Category\CategoryDataTable;
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
}

<?php

namespace App\Http\Controllers;

use App\DataTables\Permission\PermissionDataTable;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Services\Permission\PermissionServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionRequest;
use App\Repositories\Module\ModuleRepositoryInterface;

class PermissionController extends Controller
{
    protected $repository;

    protected $moduleRepository;

    protected $service;

    public function __construct(
        PermissionRepositoryInterface $repository,
        ModuleRepositoryInterface $moduleRepository,
        PermissionServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->moduleRepository = $moduleRepository;
        $this->service = $service;
    }

    public function index(PermissionDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý quyền']];
        return $dataTable->render('permission.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $modules = $this->moduleRepository->getAll();
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý quyền']];
        return view('permission.create', compact('modules', 'breadcrumbs'));
    }

    public function store(PermissionRequest $request)
    {
        $this->service->store($request);
        notyf()->success('Thêm quyền thành công');
        return redirect()->route('permissions.index');
    }

    public function edit(int $id)
    {
        $permission = $this->repository->findOrFail($id);
        $modules = $this->moduleRepository->getAll();
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý quyền']];
        return view('permission.edit', compact('permission', 'modules', 'breadcrumbs'));
    }

    public function update(PermissionRequest $request)
    {
        $this->service->update($request);
        notyf()->success('Cập nhật quyền thành công');
        return redirect()->route('permissions.index');
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa quyền thành công']);
    }
}

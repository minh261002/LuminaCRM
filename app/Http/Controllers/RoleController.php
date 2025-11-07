<?php

namespace App\Http\Controllers;

use App\DataTables\Role\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\Role\RoleServiceInterface;

class RoleController extends Controller
{
    protected $repository;

    protected $moduleRepository;

    protected $service;

    public function __construct(
        RoleRepositoryInterface $repository,
        RoleServiceInterface $service,
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(RoleDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý vai trò']];
        return $dataTable->render('role.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý vai trò']];
        $modules = $this->repository->getAllPermissionsInAllModules();
        return view('role.create', compact('modules', 'breadcrumbs'));
    }

    public function store(RoleRequest $request)
    {
        $this->service->store($request);
        notyf()->success('Thêm vai trò thành công');
        return redirect()->route('roles.index');
    }

    public function edit(int $id)
    {
        $role = $this->repository->find($id);
        $modules = $this->repository->getAllPermissionsInAllModules();
        $permissionIdArray = $role->permissions->pluck('id')->toArray();
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý vai trò']];
        return view('role.edit', compact('role', 'modules', 'breadcrumbs', 'permissionIdArray'));
    }

    public function update(RoleRequest $request)
    {
        $this->service->update($request);
        notyf()->success('Cập nhật vai trò thành công');
        return redirect()->route('roles.index');
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa vai trò thành công']);
    }
}
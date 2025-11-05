<?php

namespace App\Http\Controllers;

use App\DataTables\Module\ModuleDataTable;
use App\Enums\ModuleStatus;
use App\Repositories\Module\ModuleRepositoryInterface;
use App\Services\Module\ModuleServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Module\ModuleRequest;

class PermissionController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        ModuleRepositoryInterface $repository,
        ModuleServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(ModuleDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý module']];
        return $dataTable->render('module.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $status = ModuleStatus::asSelectArray();
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý module']];
        return view('module.create', compact('status', 'breadcrumbs'));
    }

    public function store(ModuleRequest $request)
    {
        $this->service->store($request);
        notyf()->success('Thêm module mới thành công');
        return redirect()->route('module.index');
    }

    public function edit(int $id)
    {
        $status = ModuleStatus::asSelectArray();
        $module = $this->repository->findOrFail($id);
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý module']];
        return view('module.edit', compact('module', 'status', 'breadcrumbs'));
    }

    public function update(ModuleRequest $request)
    {
        $this->service->update($request);
        notyf()->success('Cập nhật module thành công');
        return redirect()->route('module.index');
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success', 'message' => 'Xóa module thành công']);
    }
}
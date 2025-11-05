<?php

namespace App\Http\Controllers;

use App\DataTables\Module\ModuleDataTable;
use App\Repositories\Module\ModuleRepositoryInterface;
use App\Services\Module\ModuleServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Module\ModuleRequest;

class ModuleController extends Controller
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
        return $dataTable->render('module.index');
    }

    public function create()
    {
        $status = [
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
        ];
        return view('module.store', compact('status'));
    }

    public function store(ModuleRequest $request)
    {
        $this->service->store($request);
        notyf()->success('Thêm module mới thành công');
        return redirect()->route('module.index');
    }

    public function edit(int $id)
    {
        $status = [
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
        ];
        $module = $this->repository->findOrFail($id);
        return view('module.store', compact('module', 'status'));
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

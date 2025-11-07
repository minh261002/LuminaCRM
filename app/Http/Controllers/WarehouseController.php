<?php

namespace App\Http\Controllers;

use App\DataTables\Warehouse\WarehouseDataTable;
use App\Http\Requests\Warehouse\WarehouseRequest;
use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\Warehouse\WarehouseRepositoryInterface;
use App\Services\Warehouse\WarehouseServiceInterface;

class WarehouseController extends Controller
{
    protected $repository;

    protected $branchRepository;

    protected $service;

    public function __construct(
        WarehouseRepositoryInterface $repository,
        BranchRepositoryInterface $branchRepository,
        WarehouseServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->branchRepository = $branchRepository;
        $this->service = $service;
    }

    public function index(WarehouseDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý kho hàng']];

        return $dataTable->render('warehouse.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý kho hàng']];
        $branches = $this->branchRepository->getByQueryBuilder(
            ['is_active' => true],
        )->get();

        return view('warehouse.create', compact('breadcrumbs', 'branches'));
    }

    public function store(WarehouseRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm chi nhánh mới thành công.');
        } else {
            notyf()->error('Thêm chi nhánh mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('warehouses.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý kho hàng']];
        $warehouse = $this->repository->find($id);
        $branches = $this->branchRepository->getByQueryBuilder(
            ['is_active' => true],
        )->get();
        view()->share('model', $warehouse);

        return view('warehouse.edit', compact('breadcrumbs', 'warehouse', 'branches'));
    }

    public function update(WarehouseRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin kho hàng thành công.');
        } else {
            notyf()->error('Cập nhật thông tin kho hàng thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('warehouses.index');
    }

    public function active($id)
    {
        $warehouse = $this->repository->find($id);
        $warehouse->is_active = ! $warehouse->is_active;
        $warehouse->save();

        return response()->json(['success' => true]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin kho hàng thành công ']);
    }
}

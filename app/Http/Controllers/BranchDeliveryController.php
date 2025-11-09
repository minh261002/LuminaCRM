<?php

namespace App\Http\Controllers;

use App\DataTables\BranchDelivery\BranchDeliveryDataTable;
use App\Http\Requests\BranchDelivery\BranchDeliveryRequest;
use App\Repositories\BranchDelivery\BranchDeliveryRepositoryInterface;
use App\Services\BranchDelivery\BranchDeliveryServiceInterface;

class BranchDeliveryController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(
        BranchDeliveryRepositoryInterface $repository,
        BranchDeliveryServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(BranchDeliveryDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý địa điểm giao hàng']];

        return $dataTable->render('branch-delivery.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý địa điểm giao hàng']];

        return view('branch-delivery.create', compact('breadcrumbs'));
    }

    public function store(BranchDeliveryRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm địa điểm mới thành công.');
        } else {
            notyf()->error('Thêm địa điểm mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('branch-deliveries.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý địa điểm giao hàng']];
        $branchDelivery = $this->repository->find($id);
        view()->share('model', $branchDelivery);

        return view('branch-delivery.edit', compact('breadcrumbs', 'branchDelivery'));
    }

    public function update(BranchDeliveryRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin chi nhánh thành công.');
        } else {
            notyf()->error('Cập nhật thông tin chi nhánh thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('branch-deliveries.index');
    }

    public function active($id)
    {
        $user = $this->repository->find($id);
        $user->is_active = ! $user->is_active;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin địa điểm giao hàng thành công ']);
    }
}

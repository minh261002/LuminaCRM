<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerRegion\CustomerRegionDataTable;
use App\Http\Requests\CustomerRegion\CustomerRegionRequest;
use App\Repositories\CustomerRegion\CustomerRegionRepositoryInterface;
use App\Services\CustomerRegion\CustomerRegionServiceInterface;

class CustomerRegionController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(CustomerRegionRepositoryInterface $repository, CustomerRegionServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(CustomerRegionDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân phân vùng địa lý']];

        return $dataTable->render('customer-region.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân phân vùng địa lý']];
        $regions = $this->repository->getAll()->pluck('name', 'id');

        return view('customer-region.create', compact('breadcrumbs', 'regions'));
    }

    public function store(CustomerRegionRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm phân phân vùng địa lý mới thành công.');
        } else {
            notyf()->error('Thêm phân phân vùng địa lý mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('customer-regions.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân phân vùng địa lý']];
        $customerRegion = $this->repository->find($id);
        $regions = $this->repository->getAll()->pluck('name', 'id');
        view()->share('model', $customerRegion);

        return view('customer-region.edit', compact('breadcrumbs', 'customerRegion', 'regions'));
    }

    public function update(CustomerRegionRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin phân phân vùng địa lý thành công.');
        } else {
            notyf()->error('Cập nhật thông tin phân phân vùng địa lý thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('customer-regions.index');
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

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin phân phân vùng địa lý thành công ']);
    }
}

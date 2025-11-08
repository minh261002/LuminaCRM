<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerType\CustomerTypeDataTable;
use App\Http\Requests\CustomerType\CustomerTypeRequest;
use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;
use App\Services\CustomerType\CustomerTypeServiceInterface;

class CustomerTypeController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(CustomerTypeRepositoryInterface $repository, CustomerTypeServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(CustomerTypeDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân khúc khách hàng']];

        return $dataTable->render('customer-type.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân khúc khách hàng']];

        return view('customer-type.create', compact('breadcrumbs'));
    }

    public function store(CustomerTypeRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm phân khúc khách hàng mới thành công.');
        } else {
            notyf()->error('Thêm phân khúc khách hàng mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('customer-types.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phân khúc khách hàng']];
        $customerType = $this->repository->find($id);
        view()->share('model', $customerType);

        return view('customer-type.edit', compact('breadcrumbs', 'customerType'));
    }

    public function update(CustomerTypeRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin phân khúc khách hàng thành công.');
        } else {
            notyf()->error('Cập nhật thông tin phân khúc khách hàng thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('customer-types.index');
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

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin phân khúc khách hàng thành công ']);
    }
}

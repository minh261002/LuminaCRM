<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentMethod\PaymentMethodDataTable;
use App\Http\Requests\PaymentMethod\PaymentMethodRequest;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Services\PaymentMethod\PaymentMethodServiceInterface;

class PaymentMethodController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(PaymentMethodRepositoryInterface $repository, PaymentMethodServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(PaymentMethodDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phương thức thanh toán']];

        return $dataTable->render('payment-method.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phương thức thanh toán']];

        return view('payment-method.create', compact('breadcrumbs'));
    }

    public function store(PaymentMethodRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm phương thức thanh toán mới thành công.');
        } else {
            notyf()->error('Thêm phương thức thanh toán mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('payment-methods.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý phương thức thanh toán']];
        $paymentMethod = $this->repository->find($id);
        view()->share('model', $paymentMethod);

        return view('payment-method.edit', compact('breadcrumbs', 'paymentMethod'));
    }

    public function update(PaymentMethodRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin phương thức thanh toán thành công.');
        } else {
            notyf()->error('Cập nhật thông tin phương thức thanh toán thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('payment-methods.index');
    }

    public function active($id)
    {
        $paymentMethod = $this->repository->find($id);
        $paymentMethod->is_active = ! $paymentMethod->is_active;
        $paymentMethod->save();

        return response()->json(['success' => true]);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin phương thức thanh toán thành công ']);
    }
}

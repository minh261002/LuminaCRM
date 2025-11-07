<?php

namespace App\Http\Controllers;

use App\DataTables\Branch\BranchDataTable;
use App\Http\Requests\Branch\BranchRequest;
use App\Repositories\Branch\BranchRepositoryInterface;
use App\Services\Branch\BranchServiceInterface;

class BranchController extends Controller
{
    protected $repository;

    protected $service;

    public function __construct(
        BranchRepositoryInterface $repository,
        BranchServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(BranchDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý chi nhánh']];

        return $dataTable->render('branch.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý chi nhánh']];

        return view('branch.create', compact('breadcrumbs'));
    }

    public function store(BranchRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm chi nhánh mới thành công.');
        } else {
            notyf()->error('Thêm chi nhánh mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('branches.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý chi nhánh']];
        $branch = $this->repository->find($id);
        view()->share('model', $branch);

        return view('branch.edit', compact('breadcrumbs', 'branch'));
    }

    public function update(BranchRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật thông tin chi nhánh thành công.');
        } else {
            notyf()->error('Cập nhật thông tin chi nhánh thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('branches.index');
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

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin chi nhánh thành công ']);
    }
}

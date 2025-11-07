<?php

namespace App\Http\Controllers;

use App\DataTables\User\UserDataTable;
use App\Enums\Gender;
use App\Enums\IdentityType;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    protected $repository;

    protected $roleRepository;

    protected $service;

    public function __construct(
        UserRepositoryInterface $repository,
        RoleRepositoryInterface $roleRepository,
        UserServiceInterface $service)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->service = $service;
    }

    public function index(UserDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];

        return $dataTable->render('user.index', compact('breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];

        $roles = $this->roleRepository->getAll()->pluck('title', 'name')->toArray();

        $genders = Gender::asSelectArray();
        $identityTypes = IdentityType::asSelectArray();

        return view('user.create', compact('breadcrumbs', 'roles', 'genders', 'identityTypes'));
    }

    public function store(UserRequest $request)
    {
        if ($this->service->store($request)) {
            notyf()->success('Thêm nhân viên mới thành công.');
        } else {
            notyf()->error('Thêm nhân viên mới thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];

        $roles = $this->roleRepository->getAll()->pluck('title', 'name')->toArray();

        $genders = Gender::asSelectArray();
        $identityTypes = IdentityType::asSelectArray();
        $user = $this->repository->findOrFail($id);
        view()->share('model', $user);

        return view('user.edit', compact('breadcrumbs', 'roles', 'genders', 'identityTypes', 'user'));
    }

    public function update(UserRequest $request)
    {
        if ($this->service->update($request)) {
            notyf()->success('Cập nhật nhân viên thành công.');
        } else {
            notyf()->error('Cập nhật nhân viên thất bại. Vui lòng thử lại.');
        }

        return redirect()->route('users.index');
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

        return response()->json(['status' => 'success', 'message' => 'Xóa thông tin nhân viên thành công ']);
    }
}

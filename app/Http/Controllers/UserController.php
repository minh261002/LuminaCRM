<?php

namespace App\Http\Controllers;

use App\DataTables\User\UserDataTable;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use App\Enums\Gender;

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

    public function index(UserDataTable $dataTable){
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];
        return $dataTable->render('user.index', compact('breadcrumbs'));
    }

    public function create(){
        $roles = $this->roleRepository->getAll()->pluck('title', 'id')->toArray();
        $genders = Gender::asSelectArray();
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];
        return view('user.create', compact('breadcrumbs', 'roles', 'genders'));
    }

    public function store(Request $request){
      dd($request->all());
    }

    public function active($id)
    {
        $user = $this->repository->find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\User\UserDataTable;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        UserRepositoryInterface $repository,
        UserServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(UserDataTable $dataTable){
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];
        return $dataTable->render('user.index', compact('breadcrumbs'));
    }

    public function create(){
        $breadcrumbs = [['name' => 'Bảng điều khiển', 'url' => route('dashboard')], ['name' => 'Quản lý nhân viên']];
        return view('user.create', compact('breadcrumbs'));
    }

    public function active($id)
    {
        $user = $this->repository->find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json(['success' => true]);
    }
}

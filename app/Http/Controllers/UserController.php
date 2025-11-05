<?php

namespace App\Http\Controllers;

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

    public function index( $dataTable){}
}

<?php

namespace App\Services\User;


use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $role = $data['role_id'];
        unset($data['role_id']);

        $data['avatar'] = $data['avatar'] ?? '/images/not-found.jpg';

        $data['password'] = Hash::make($data['password']);

        if ($data['birthday']) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        $user =  $this->repository->create($data);
        $user->role()->attach($role);

        return $user;
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        $role = $data['role_id'];
        unset($data['role_id']);
        $data['image'] = $data['image'] ?? '/images/not-found.jpg';

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->repository->update($data['id'], $data);
        $user->role()->attach($role);

        return $user;
    }

}
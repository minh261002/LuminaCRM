<?php

namespace App\Services\CustomerType;

use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;
use Illuminate\Http\Request;

class CustomerTypeService implements CustomerTypeServiceInterface
{
    protected $repository;

    public function __construct(CustomerTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        } else {
            $data['is_active'] = 1;
        }

        return $this->repository->create($data);
    }

    public function update(Request $request)
    {
        $data = $request->validated();
        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        } else {
            $data['is_active'] = 1;
        }

        return $this->repository->update($data['id'], $data);
    }
}

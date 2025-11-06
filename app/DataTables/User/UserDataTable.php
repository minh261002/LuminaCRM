<?php

namespace App\DataTables\User;

use App\DataTables\BaseDataTable;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserDataTable extends BaseDataTable
{
    protected $nameTable = 'userTable';
    protected $repository;
    protected $roleRepository;

    public function __construct(
        UserRepositoryInterface $repository,
        RoleRepositoryInterface $roleRepository
    ) {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'user.datatable.action',
            'code' => 'user.datatable.code',
            'name' => 'user.datatable.name',
            'role' => 'user.datatable.role',
            'is_active' => 'user.datatable.is_active',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [0, 1, 2, 3, 4];
        $this->columnSearchDate = [4];
        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => $this->roleRepository->getAll()->pluck('title', 'id')->toArray()
            ],
            [
                'column' => 3,
                'data' => [
                    true => 'Hoạt động',
                    false => 'Không hoạt động',
                ]
            ]
        ];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.users', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'code' =>function ($user) {
                return view('user.datatable.code', compact('user'))->render();
            },
            'info' => function ($user) {
                return view('user.datatable.info', compact('user'))->render();
            },
            'role' => function ($user) {
                return view('user.datatable.role', compact('user'))->render();
            },
            'is_active' => function ($user) {
                return view('user.datatable.is_active', compact('user'))->render();
            },
            'created_at' => '{{formatDate($created_at)}}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->views['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = [
            'action',
            'code',
            'info',
            'role',
            'is_active',
            'status',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'role' => function ($query, $keyword) {
                $query->whereHas('role', function ($query) use ($keyword) {
                    $query->where('id', 'like', '%' . $keyword . '%');
                });
            },
            'code' => function($query, $keyword) {
                $query->where('users.code', 'like', '%' . $keyword . '%')
                ->orWhere('users.name', 'like', '%' . $keyword . '%');
            },
            'info' => function($query, $keyword) {
                $query->where('users.email', 'like', '%' . $keyword . '%')
                ->orWhere('users.phone', 'like', '%' . $keyword . '%');
            },
        ];
    }
}

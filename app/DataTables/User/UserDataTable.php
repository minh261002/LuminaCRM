<?php

namespace App\DataTables\User;

use App\DataTables\BaseDataTable;
use App\Repositories\User\UserRepositoryInterface;

class UserDataTable extends BaseDataTable
{
    protected $nameTable = 'userTable';
    protected $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'user.datatable.action',
            'image' => 'user.datatable.image',
            'role' => 'user.datatable.role',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [1, 2, 3, 4, 5, 6];
        $this->columnSearchDate = [6];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.users', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'image' => $this->views['image'],
            'status' => $this->views['status'],
            'created_at' => '{{format_datetime($created_at)}}',
            'login_type' => $this->views['login_type'],
            'role' => $this->views['role'],
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
            'image',
            'status',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}

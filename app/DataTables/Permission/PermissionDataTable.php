<?php

namespace App\DataTables\Permission;

use App\DataTables\BaseDataTable;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Module\ModuleRepositoryInterface;

class PermissionDataTable extends BaseDataTable
{
    protected $nameTable = 'permissionTable';
    protected $repository;
    protected $moduleRepository;

    public function __construct(
        PermissionRepositoryInterface $repository,
        ModuleRepositoryInterface $moduleRepository
    ) {
        $this->repository = $repository;
        $this->moduleRepository = $moduleRepository;
        parent::__construct();
    }
    public function setView(): void
    {
        $this->views = [
            'action' => 'permission.datatable.action',
        ];
    }
    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4];
        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => $this->moduleRepository->getAll()->pluck('name', 'id')->toArray()
            ]
        ];
        $this->columnSearchDate = [4];
    }
    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.permissions', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'module_id' => function ($permission) {
                return $permission->module->name;
            },
            'name' => function ($permission) {
                return '<code>' . $permission->name . '</code>';
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
            'name',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}

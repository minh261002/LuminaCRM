<?php

namespace App\DataTables\Branch;

use App\DataTables\BaseDataTable;
use App\Repositories\Branch\BranchRepositoryInterface;

class BranchDataTable extends BaseDataTable
{
    protected $nameTable = 'branchTable';

    protected $repository;

    public function __construct(
        BranchRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'branch.datatable.action',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];

    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.roles', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'name' => function ($role) {
                return '<code>'.$role->name.'</code>';
            },
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

<?php

namespace App\DataTables\Branch;

use App\DataTables\BaseDataTable;
use App\Repositories\Branch\BranchRepositoryInterface;

class CustomerTypeDataTable extends BaseDataTable
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
            'is_active' => 'branch.datatable.is_active',
            'address' => 'branch.datatable.address',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3];
        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => [
                    true => 'Hoạt động',
                    false => 'Không hoạt động',
                ],
            ],
        ];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.branches', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'is_active' => function ($branch) {
                return view($this->views['is_active'], compact('branch'))->render();
            },
            'address' => function ($branch) {
                return view($this->views['address'], compact('branch'))->render();
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
            'is_active',
            'address',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}

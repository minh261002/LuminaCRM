<?php

namespace App\DataTables\BranchDelivery;

use App\DataTables\BaseDataTable;
use App\Repositories\BranchDelivery\BranchDeliveryRepositoryInterface;

class BranchDeliveryDataTable extends BaseDataTable
{
    protected $nameTable = 'branchTable';

    protected $repository;

    public function __construct(
        BranchDeliveryRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'branch-delivery.datatable.action',
            'is_active' => 'branch-delivery.datatable.is_active',
            'address' => 'branch-delivery.datatable.address',
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
        $this->customColumns = config('datatable_columns.branch_deliveries', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'is_active' => function ($branchDelivery) {
                return view($this->views['is_active'], compact('branchDelivery'))->render();
            },
            'address' => function ($branchDelivery) {
                return view($this->views['address'], compact('branchDelivery'))->render();
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

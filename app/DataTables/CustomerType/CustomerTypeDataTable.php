<?php

namespace App\DataTables\CustomerType;

use App\DataTables\BaseDataTable;
use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;

class CustomerTypeDataTable extends BaseDataTable
{
    protected $nameTable = 'customerTypeTable';

    protected $repository;

    public function __construct(
        CustomerTypeRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'customer-type.datatable.action',
            'is_active' => 'customer-type.datatable.is_active',
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
                'column' => 4,
                'data' => [
                    true => 'Hoạt động',
                    false => 'Không hoạt động',
                ],
            ],
        ];
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatable_columns.customer_types', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'is_active' => function ($customerType) {
                return view($this->views['is_active'], compact('customerType'))->render();
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
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}

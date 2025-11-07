<?php

namespace App\DataTables\Warehouse;

use App\DataTables\BaseDataTable;
use App\Repositories\Warehouse\WarehouseRepositoryInterface;

class WarehouseDataTable extends BaseDataTable
{
    protected $nameTable = 'warehouseTable';

    protected $repository;

    public function __construct(
        WarehouseRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'warehouse.datatable.action',
            'is_active' => 'warehouse.datatable.is_active',
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
        $this->customColumns = config('datatable_columns.warehouses', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'created_at' => '{{formatDate($created_at)}}',
            'is_active' => function ($warehouse) {
                return view('warehouse.datatable.is_active', compact('warehouse'))->render();
            },
            'branch_id' => function ($warehouse) {
                return $warehouse->branch->name;
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
            'created_at',
            'action',
            'is_active',
            'address',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'branch_id' => function ($query, $keyword) {
                $query->whereHas('branch', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                });
            },
        ];
    }
}

<?php

namespace App\DataTables\CustomerRegion;

use App\DataTables\BaseDataTable;
use App\Repositories\CustomerRegion\CustomerRegionRepositoryInterface;

class CustomerRegionDataTable extends BaseDataTable
{
    protected $nameTable = 'customerRegionTable';

    protected $repository;

    public function __construct(
        CustomerRegionRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'customer-region.datatable.action',
            'is_active' => 'customer-region.datatable.is_active',
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
        $this->customColumns = config('datatable_columns.customer_regions', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'is_active' => function ($customerRegion) {
                return view($this->views['is_active'], compact('customerRegion'))->render();
            },
            'parent_region_id' => function ($customerRegion) {
                return $customerRegion->parent ? $customerRegion->parent->name : '-';
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
            'parent_region_id' => function ($query, $keyword) {
                $query->whereHas('parent', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            },
        ];
    }
}

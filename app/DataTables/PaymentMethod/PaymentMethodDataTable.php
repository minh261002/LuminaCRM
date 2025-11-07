<?php

namespace App\DataTables\PaymentMethod;

use App\DataTables\BaseDataTable;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;

class PaymentMethodDataTable extends BaseDataTable
{
    protected $nameTable = 'paymentMethodTable';

    protected $repository;

    public function __construct(
        PaymentMethodRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'payment-method.datatable.action',
            'is_active' => 'payment-method.datatable.is_active',
            'icon' => 'payment-method.datatable.icon',
        ];
    }

    public function query()
    {
        return $this->repository->getQueryBuilderOrderBy();
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [1, 2, 3, 4];
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
        $this->customColumns = config('datatable_columns.payment_methods', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'is_active' => function ($paymentMethod) {
                return view($this->views['is_active'], compact('paymentMethod'))->render();
            },
            'icon' => $this->views['icon'],
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
            'is_active',
            'icon',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            //
        ];
    }
}

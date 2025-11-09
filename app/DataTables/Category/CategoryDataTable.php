<?php

namespace App\DataTables\Category;

use App\DataTables\BaseDataTable;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryDataTable extends BaseDataTable
{
    protected $nameTable = 'categoryTable';

    protected $repository;

    public function __construct(
        CategoryRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct();
    }

    public function setView(): void
    {
        $this->views = [
            'action' => 'category.datatable.action',
            'is_active' => 'category.datatable.is_active',
            'image' => 'category.datatable.image',
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
        $this->customColumns = config('datatable_columns.categories', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'action' => $this->views['action'],
            'created_at' => '{{formatDate($created_at)}}',
            'is_active' => function ($category) {
                return view($this->views['is_active'], compact('category'))->render();
            },
            'image' => function ($category) {
                return view($this->views['image'], compact('category'))->render();
            },
            'parent_id' => function ($category) {
                return $category->parent ? $category->parent->name : '---';
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
            'image',
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'parent_id' => function ($query, $keyword) {
                $query->whereHas('parent', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            },
        ];
    }
}

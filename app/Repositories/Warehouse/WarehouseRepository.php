<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse;
use App\Repositories\BaseRepository;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    public function getModel()
    {
        return Warehouse::class;
    }
}

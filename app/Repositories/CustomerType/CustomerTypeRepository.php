<?php

namespace App\Repositories\CustomerType;

use App\Models\CustomerType;
use App\Repositories\BaseRepository;

class CustomerTypeRepository extends BaseRepository implements CustomerTypeRepositoryInterface
{
    public function getModel()
    {
        return CustomerType::class;
    }
}

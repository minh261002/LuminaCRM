<?php

namespace App\Repositories\CustomerRegion;

use App\Models\CustomerRegion;
use App\Repositories\BaseRepository;

class CustomerRegionRepository extends BaseRepository implements CustomerRegionRepositoryInterface
{
    public function getModel()
    {
        return CustomerRegion::class;
    }
}

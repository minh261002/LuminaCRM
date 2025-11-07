<?php

namespace App\Repositories\BranchDelivery;

use App\Models\BranchDelivery;
use App\Repositories\BaseRepository;

class BranchDeliveryRepository extends BaseRepository implements BranchDeliveryRepositoryInterface
{
    public function getModel()
    {
        return BranchDelivery::class;
    }
}

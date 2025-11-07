<?php

namespace App\Repositories\Branch;

use App\Models\Branch;
use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    public function getModel()
    {
        return Branch::class;
    }
}

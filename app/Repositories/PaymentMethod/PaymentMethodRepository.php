<?php

namespace App\Repositories\PaymentMethod;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    public function getModel()
    {
        return PaymentMethod::class;
    }
}

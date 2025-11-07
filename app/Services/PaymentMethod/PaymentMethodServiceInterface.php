<?php

namespace App\Services\PaymentMethod;

use Illuminate\Http\Request;

interface PaymentMethodServiceInterface
{
    public function store(Request $request);

    public function update(Request $request);
}

<?php

namespace App\Services\BranchDelivery;

use Illuminate\Http\Request;

interface BranchDeliveryServiceInterface
{
    public function store(Request $request);

    public function update(Request $request);
}

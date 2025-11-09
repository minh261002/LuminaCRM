<?php

namespace App\Services\CustomerRegion;

use Illuminate\Http\Request;

interface CustomerRegionServiceInterface
{
    public function store(Request $request);

    public function update(Request $request);
}

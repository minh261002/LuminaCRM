<?php

namespace App\Services\CustomerType;

use Illuminate\Http\Request;

interface CustomerTypeServiceInterface
{
    public function store(Request $request);

    public function update(Request $request);
}

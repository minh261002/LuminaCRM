<?php

namespace App\Services\Branch;

use Illuminate\Http\Request;

interface BranchServiceInterface
{
    public function store(Request $request);

    public function update(Request $request);
}

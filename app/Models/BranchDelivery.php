<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchDelivery extends Model
{
    use HasFactory;

    protected $table = 'branch_deliveries';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_code', 'ward_code');
    }
}

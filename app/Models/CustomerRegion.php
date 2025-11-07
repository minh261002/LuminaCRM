<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRegion extends Model
{
    use HasFactory;

    protected $table = 'customer_regions';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(CustomerRegion::class, 'parent_region_id');
    }

    public function children()
    {
        return $this->hasMany(CustomerRegion::class, 'parent_region_id');
    }
}

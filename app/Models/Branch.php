<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function province()
    {
        return $this->belongsTo(Location::class, 'province_code', 'code');
    }

    public function ward()
    {
        return $this->belongsTo(Location::class, 'ward_code', 'ward_code');
    }
}

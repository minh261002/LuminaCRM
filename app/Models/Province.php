<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $guarded = [];

    protected $casts = [];

    public function wards()
    {
        return $this->hasMany(Ward::class, 'province_code', 'code');
    }
}

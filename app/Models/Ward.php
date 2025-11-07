<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';

    protected $guarded = [];

    protected $casts = [];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }
}

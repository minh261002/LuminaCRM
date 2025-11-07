<?php

namespace App\Models;

use App\Enums\IdentityType;
use Illuminate\Database\Eloquent\Model;

class IdentifyDocument extends Model
{
    protected $table = 'identity_documents';

    protected $guarded = [];

    protected $casts = [
        'type' => IdentityType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function orders() {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $guarded = ['id', 'user_id'];

    public function customer() {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    public function environments() {
        return $this->belongsToMany(\App\Models\Environment::class)->withTimestamps();
    }
}

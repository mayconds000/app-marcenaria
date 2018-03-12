<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Environment extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function products() {
        return $this->belongstoMany(\App\Models\Product::class)->withTimestamps();
    }

    public function order() {
        return $this->belongsToMany(\App\Models\Order::class)->withTimestamps();
    }

}

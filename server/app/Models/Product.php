<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected  $fillable = ['name', 'environment'];

    public $timestamps = false;


    public function environment() {
        return $this->belongsToMany(\App\Models\Environment::class)->withTimestamps();
    }
}

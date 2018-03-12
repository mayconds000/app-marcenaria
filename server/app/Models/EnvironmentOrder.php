<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EnvironmentOrder extends Model
{
    protected $fillable = ['name', 'environment_id', 'oder_id'];
}

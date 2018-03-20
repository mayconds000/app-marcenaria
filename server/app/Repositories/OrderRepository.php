<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquent\Repository;

class OrderRepository extends Repository {
    function model()
    {
        return 'App\Models\Order';
    }
}
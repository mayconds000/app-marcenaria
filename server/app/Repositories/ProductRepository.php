<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\Repository;

class ProductRepository extends Repository {
    function model()
    {
        return 'App\Models\Product';
    }
}
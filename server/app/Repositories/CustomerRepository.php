<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Eloquent\Repository;

class CustomerRepository extends Repository {
    function model()
    {
        return 'App\Models\Customer';
    }
}
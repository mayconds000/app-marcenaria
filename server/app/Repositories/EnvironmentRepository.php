<?php

namespace App\Repositories;

use App\Models\Environment;
use App\Repositories\Contracts\EnvironmentRepositoryInterface;
use App\Repositories\Eloquent\Repository;

class EnvironmentRepository extends Repository {
    function model()
    {
        return 'App\Models\Environment';
    }
}
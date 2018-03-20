<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\Repository;

class UserRepository extends Repository {
    function model()
    {
        return 'App\Models\User';
    }
}
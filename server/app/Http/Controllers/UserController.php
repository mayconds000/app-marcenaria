<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository as User;

class UserController extends Controller
{
    protected $repository;
    
    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    protected function validateCreate(Request $request) {
        return Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);
    }

    protected function validateUpdate(Request $request) {
        return Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'min:6'
        ]);
    }

}

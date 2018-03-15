<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
    
    }

    public function all() {
        return response()->json(User::all());
    }

    public function create(Request $request) {

    }

    public function find($id) {

    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {

    }
}

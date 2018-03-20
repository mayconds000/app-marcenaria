<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CustomerRepository as Customer;



class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $customer;
    
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function all() {
        return response()->json($this->customer->all());
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:customers',
            'password' => 'required|min:6'    
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                "error" => ["errors" => $errors],
                "status" => 500,
                "message" => "Bad Request"
            ], 500);
        }

        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = app('hash')->make($data['password']);

        if ($customer = $this->customer->create($data)) {
            return response()->json($customer, 200);
        }

        return response()->json([
            "error" => ["errors" => ["Não foi possível criar o usuário."]],
            "status" => 500,
            "message" => "Não foi possível gravar o usuário no banco de dados",
        ], 500);
    }
    
    public function find($id) {
        $customer = $this->customer->find($id);
        if ($customer) { return response()->json($customer, 200); }
        return response()->json([
            "status" => 400,
            "message" => "Bad request",
            "error" => ["errors" => ["Usuário não encontrado"]]
        ], 400);
    }

    public function update(Request $request, $id) {
        $res = $this->customer->update($request->all(), $id);
        if (! $res) {
            return response()->json([
                "status" => 400,
                "message" => "Bad request",
                "error" => ["errors" => ["Usuário não encontrado"]]
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'customer' => $this->customer->find($id)
        ], 200);
    }

    public function delete($id) {
        $res = $this->customer->delete($id);
        if ($res) { 
            return response()->json([
                "status" => 200,
                "message" => "ok"
            ], 200);
        }
    }
}

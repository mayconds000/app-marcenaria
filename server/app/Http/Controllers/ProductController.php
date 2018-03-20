<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ProductRepository as Product;



class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $product;
    
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all() {
        return response()->json($this->product->all());
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

        if ($product = $this->product->create($data)) {
            return response()->json($product, 200);
        }

        return response()->json([
            "error" => ["errors" => ["Não foi possível criar o usuário."]],
            "status" => 500,
            "message" => "Não foi possível gravar o usuário no banco de dados",
        ], 500);
    }
    
    public function find($id) {
        $product = $this->product->find($id);
        if ($product) { return response()->json($product, 200); }
        return response()->json([
            "status" => 400,
            "message" => "Bad request",
            "error" => ["errors" => ["Usuário não encontrado"]]
        ], 400);
    }

    public function update(Request $request, $id) {
        $res = $this->product->update($request->all(), $id);
        if (! $res) {
            return response()->json([
                "status" => 400,
                "message" => "Bad request",
                "error" => ["errors" => ["Usuário não encontrado"]]
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'customer' => $this->product->find($id)
        ], 200);
    }

    public function delete($id) {
        $res = $this->product->delete($id);
        if ($res) { 
            return response()->json([
                "status" => 200,
                "message" => "ok"
            ], 200);
        }
    }
}

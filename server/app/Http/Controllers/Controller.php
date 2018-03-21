<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;

abstract class Controller extends BaseController
{
    protected $repository;

    abstract protected function validateCreate(Request $request);
    abstract protected function validateUpdate(Request $request);

    public function all() {
        return response()->json($this->repository->all());
    }

    public function create(Request $request) {
        $validator = $this->validateCreate($request);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                "status" => 400,
                "errors" => ["fields" => $errors],
            ], 400);
        }

        if ($model = $this->repository->create($request->all())) {
            return response()->json($model, 200);
        }

        return response()->json([
            "status" => 422,
            "errors" => ["Houve uma falha ao cadastrar"]
        ], 422);
    }

    public function find($id) {
        if ($model = $this->repository->find($id)) {
            return response()->json($model, 200);
        }

        return response()->json([
            "status" => 404,
            "errors" => ["Registro não encontrado"]
        ], 400);
    }

    public function update(Request $request, $id) {
        $validator = $this->validateUpdate($request);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return response()->json([
                "status" => 400,
                "errors" => ["fields" => $errors],
            ], 400);
        }

        if ($response = $this->repository->update($request->all(), $id)) {
            return response()->json($response, 200);
        }

        return response()->json([
            "status" => 422,
            "errors" => ["Não foi possível atualizar o registro"]
        ], 422);
    }

    public function delete($id) {
        if ($response = $this->repository->delete($id)) {
            return response()->json($response, 200);
        }

        return response()->json([
            "status" => 422,
            "errors" => ["Não foi possível deletar o registro"]
        ], 422);
    }
}

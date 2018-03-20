<?php 
namespace App\Repositories\Contracts;

interface OrderRepositoryInterface {
    public function all();
    public function find($id);
    public function store($id = null);
    public function update($id = null);
    public function delete($id);
}
<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();

    public function find($id, $columns = array('*'));

    public function findBy(Array $queryArray, $columns = array('*'));

    public function paginate($page, $limit, $columns);

    public function create(array $data);

    public function update(array $data, $id, $attribute = 'id');

    public function delete($id);
}
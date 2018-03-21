<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = array('*'), $page = 1, $limit = 15, $customQuery = null);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id, $attribute = 'id');

    public function delete($id);
}
<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{
    private $app;
    protected $model;

    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function all() {
        return $this->model->get();
    }

    public function paginate($page = 1, $limit = 15, $columns = array('*')) {
        $per_page = intval($limit);
        $current = intval($page);
        $offset = ($current - 1) * $per_page;
        $data = $this->model->limit($per_page)->offset($offset)->get($columns);
        $total = $this->model->selectRaw('count(*) as total')->first()->total;
        $first = $total > $per_page ? 1 : null;
        $last = ceil($total / $per_page);
        $previous = $current > 1 ? $current - 1 : null;
        $next = $current < $last ? $current + 1 : null;
        $from = $offset + 1;
        $to = $current * $per_page;
        

        return compact(
            'total',
            'per_page',
            'current',
            'last',
            'next',
            'previous',
            'from',
            'to',
            'data'
        );
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = "id") {
        return $this->model->find($id)->update($data);
    }

    public function delete($id) {
        return $this->model->find($id)->delete();
    }

    public function find($id, $columns = array('*')) {
        return $this->model->find($id)->first($columns);
    }

    public function findBy(Array $queryArray, $columns = array('*')) {
        $model = $this->model;
        foreach($queryArray as $query) {
            list($column, $operator, $value) = $query;
            $operator = $operator ?? '=';
            $model->where($column, $operator, $value);
        }
        return $model->get($columns);
    }

    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        
        return $this->model = $model->newQuery();
    }
}
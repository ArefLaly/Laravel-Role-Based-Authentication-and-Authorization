<?php

namespace App\Repository\implementation;

use App\Repository\common\IGenericRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IGenericRepository
{
    private Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function all()
    {
       return $this->model->all();
    }

    public function find($id)
    {
        $this->model->find($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function delete(Model $model): void
    {
        $model->delete();
    }
    
    public function newQuery(): Builder{
        return $this->model->newQuery();
    }
}

<?php
namespace App\Repository\common;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface IGenericRepository{

    public function all();
    public function find($id);
    public function create(array $attributes): Model;
    public function delete(Model $model): void;
    
    public function newQuery(): Builder;
}
<?php

namespace App\Repositories;

use App\Model;

class BaseRepository
{
    protected $model;
        
    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function paginate($row=20)
    {
        return $this->model->paginate($row);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIdwithRelated($id, $with)
    {
        return $this->model->with($with)->find($id);
    }

    public function findByField($field, $value = null, $columns = array('*'))
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    public function findWhereIn( $field, array $values, $columns = array('*'))
    {
        return $this->model->whereIn($field, $values)->get($columns);

    }    
    
    public function findWhereNotIn( $field, array $values, $columns = array('*'))
    {
        return $this->model->whereNotIn($field, $values)->get($columns);
    }

 	public function create(array $attributes)
    {
  		return $this->model->create($attributes);
    }

 	public function update(array $attributes, $id)
    {
        $model = $this->getById($id);
     
        return $model->update($attributes);
    }

    public function delete($id)
    {
		$model = $this->getById($id);
     
        return $model->delete();
    }

}

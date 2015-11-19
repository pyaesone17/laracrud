<?php

namespace App\Repositories;
use App\Model;

class ModelRepository extends BaseRepository
{
	protected $model;
		
	public function __construct(Model $varmodel)
	{
		$this->model=$varmodel;
	}

	public function paginate($row=20)
	{
		return parent::paginate($row)->setPath('party');
	}

}
<?php

namespace App\Repositories\Base;

class BaseRepository
{
	protected $modelClass;

	/**
	 * BaseRepository constructor.
	 * @param $modelClass
	 */
	public function __construct($modelClass)
	{
		$this->modelClass = $modelClass;
	}

	/**
	 * Get all items of models
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->modelClass::all();
	}

	/**
	 * Get item of model by id
	 * @param $id
	 * @return mixed
	 */
	public function getById($id)
	{
		return $this->modelClass::findOrFail($id);
	}

	/**
	 * Store item of model with attributes
	 * @param array $attributes
	 * @return mixed
	 */
	public function save($attributes)
	{
		return $this->modelClass::create($attributes);
	}

	/**
	 * Update item of model by id
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function updateById($id, $attributes)
	{
		return $this->getById($id)->update($attributes);
	}

	/**
	 * Delete model by id
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->getById($id)->delete();
	}
}

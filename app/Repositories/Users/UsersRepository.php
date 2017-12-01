<?php

namespace App\Repositories\Users;

use App\User;

class UserRepository implements UserRepositoryInterface
{
	private $model;
	/**
	 * UserRepository constructor.
	 */
	public function __construct(User $model)
	{
		$this->model = $model;
	}


	/**
	 * Get all users
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get user by id
	 * @param $id
	 * @return mixed
	 */
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * Update user by id
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function updateById($id, $attributes)
	{
		return $this->getById($id)->update($attributes);
	}

	/**
	 * Delete user by id
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->getById($id)->delete();
	}
}
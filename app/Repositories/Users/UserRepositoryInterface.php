<?php

namespace App\Repositories\Users;


interface UserRepositoryInterface
{
	/**
	 * Get all users
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Get user by id
	 * @param $id
	 * @return mixed
	 */
	public function getById($id);

	/**
	 * Update user by id
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function updateById($id, $attributes);

	/**
	 * Delete user by id
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);
}
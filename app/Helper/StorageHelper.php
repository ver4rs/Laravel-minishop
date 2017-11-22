<?php
namespace App\Helper;

use Illuminate\Support\Facades\Storage;

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 11.11.17
 * Time: 1:22
 */
class StorageHelper
{
	/**
	 * Delete image from storage
	 * @param string $name
	 * @param string $path default products
	 */
	public function deleteImage($name, $path = 'products')
	{
		Storage::disk('images')->delete(($path ? $path . '/' : '') . $name);
	}

	/**
	 * Save image
	 * @param $file
	 * @param string $disk
	 * @param string $path
	 * @return string
	 */
	public function saveImage($file, $disk = 'images', $path = 'products')
	{
		$name = sha1(microtime()) . '.jpg';
		Storage::disk($disk)->putFileAs($path, $file, $name);

		return $name;
	}

}
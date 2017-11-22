<?php
namespace App\Helper\StorageImages;

use Illuminate\Support\Facades\Storage;

abstract class StorageImages
{
	/**
	 * Delete image from storage
	 * @param string $name
	 * @param string $path default products
	 */
	public static function deleteImage($name, $path = 'products')
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
	public static function saveImage($file, $disk = 'images', $path = 'products')
	{
		$name = sha1(microtime()) . '.jpg';
		Storage::disk($disk)->putFileAs($path, $file, $name);

		return $name;
	}

}
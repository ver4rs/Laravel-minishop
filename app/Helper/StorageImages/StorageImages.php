<?php
namespace App\Helper\StorageImages;

use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

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
		$name = self::getUuid() . $file->extension();
		Storage::disk($disk)->putFileAs($path, $file, $name);

		return $name;
	}

	/**
	 * Get unique number string "uuid"
	 * @return string
	 * @throws \Exception
	 */
	private static function getUuid()
	{
		$uuid = Uuid::generate(4);
		return $uuid->string;
	}
}
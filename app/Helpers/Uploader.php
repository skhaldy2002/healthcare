<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Uploader
{
    /*
     * instance of UploadedFile
     */
    protected $file;
    /*
     * instance of intervention image
     */
    protected $image;
    /*
     * image of image mime types
     */
    protected static $mimes = [
        'image/gif',
        'image/ief',
        'image/jpeg',
        'image/pict',
        'image/jpg',
        'image/png',
        'image/svg+xml',
        'image/tiff',
        'image/webp',
    ];

    /*
     * custom constructor
     */
    public static function make($file)
    {
        return (new  Uploader())->setFile($file);
    }

    /*
     * set $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /*
     * Create new or return an existing Intervention Image object
     */
    protected function getImage()
    {
        if (!$this->image) {
            if (self::isImage($this->file)) {
                return Image::make($this->file);
            }
        }

        return $this->image;
    }

    protected static function isImage($file, $storage = 'public')
    {
        if (is_string($file)) {
            if (Storage::disk($storage)->exists($file)) {
                return in_array(
                    Storage::disk($storage)->mimeType($file),
                    Uploader::$mimes
                );
            } else {
                return false;
            }
        } else {
            return in_array($file->getMimeType(), Uploader::$mimes);
        }
    }

    /*
     * Uploads a file under a hashed name
     */
    public function upload($path = '', $storage = 'public')
    {
        return $this->uploadAs('', $path, $storage);
    }

    /*
     * Uploads a file under a specif name
     */
    public function uploadAs($filename, $path = '', $storage = 'public')
    {
        $filename = $filename ?: $this->file->hashName();
        if ($this->image) {
            $imagePath = "{$path}/{$filename}";
            if (!Storage::disk($storage)->exists($path)) {
                Storage::disk($storage)->makeDirectory($path);
            }
            $this->image->save(Storage::disk($storage)->path($imagePath));
            return $imagePath;
        } else {
            return $this->file->storeAs($path, $filename, $storage);
        }
    }

    /**
     * @param $oldFilePath
     * @param $path
     * @param $storage
     * @return mixed
     */
    public function replace($oldFilePath, $path = '', $storage = 'public')
    {
        return $this->replaceAs($oldFilePath, '', $path, $storage);
    }

    /**
     * @param $oldFilePath
     * @param $newFilename
     * @param $path
     * @param $storage
     * @return string
     */

    public function replaceAs($oldFilePath, $newFilename, $path = '', $storage = 'public')
    {
        self::delete($oldFilePath, $storage);

        return $this->uploadAs($newFilename, $path, $storage);
    }


    /**
     * @param $filePath
     * @param $storage
     * @return void
     */
    public static function delete($filePath, $storage = 'public')
    {
        if (Storage::disk($storage)->exists($filePath)) {
            Storage::disk($storage)->delete($filePath);
        }
    }


}

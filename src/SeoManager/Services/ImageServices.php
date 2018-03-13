<?php

namespace Laravel\SeoManager\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageServices
{

    /**
     * @param $file
     * @param $object
     * @param string $key
     * @param string $disc
     */
    public static function savePhoto($file,  $object, $key = 'photo',$disc = 'public'){

        if ($file) {
            $imageFileName = time() . rand(1, 999999999) . '.' . $file->getClientOriginalExtension();
            $storage = Storage::disk($disc);
            $storage->put($imageFileName, file_get_contents($file), 'public');
            $object->$key = $imageFileName;
            $object->save();

        }
    }

    /**
     * @param $input
     * @param $name
     * @param $width
     * @param $repo
     */
    public static function attachmentThumb($input, $name, $width,$repo)
    {
        Image::make( $input)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save(base_path() .'/public/images/'.$name)->destroy();
        $s3 = Storage::disk('laravel-seo-tools');
        $filePath = "$repo/thumb/$width/" . $name;
        $s3->put($filePath, file_get_contents(public_path() . '/images/'.$name), 'public');

    }
    /**
     * Save photo to S3 server
     * @param $file
     * @param $name
     * @param $path
     * @param $object
     * @param $key
     * @return string
     */
    public static function saveS3Photo($file, $name, $path, $object, $key = 'photo')
    {
        if ($file) {
            list($name, $filePath) = self::uploadFiles($file, $name, $path);
            $object->$key = $filePath;
            $object->save();
            self::thumbGenerate(file_get_contents($file), $name, [35, 200],$path);
        }

    }

    /**
     * generate thumb for images
     * @param $input
     * @param $name
     * @param $widths
     * @param null $repo
     */
    public static function thumbGenerate($input, $name, $widths, $repo = null)
    {
        foreach ($widths as $width) {
            Image::make($input)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(base_path() . '/public/images/' . $name)->destroy();
            $s3 = Storage::disk('s3');
            $filePath = "$repo/thumb/$width/" . $name;
            $s3->put($filePath, file_get_contents(public_path() . '/images/' . $name), 'public');
        }
        unlink(base_path() . '/public/images/' . $name);
    }


    /**
     * upload all files to amazon s3 storage
     * @param $file
     * @param $name
     * @param $path
     * @return array
     */
    public static function uploadFiles($file, $name, $path): array
    {
        $s3 = Storage::disk('s3');
        $name = $name . '.' . $file->getClientOriginalExtension();
        $filePath = $path . '/' . $name;
        $s3->put($filePath, file_get_contents($file), 'public');
        return array($name, $filePath);
    }

}

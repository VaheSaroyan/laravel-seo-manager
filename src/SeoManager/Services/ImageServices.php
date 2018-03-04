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


}
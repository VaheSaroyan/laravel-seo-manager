<?php

namespace Laravel\SeoManager\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LaravelSeoManager extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'page', 'title', 'meta_keywords', 'meta_description', 'image', 'url'];

    public function getImageAttribute($value)
    {
        if (config('LaravelSeoManager.filesystem') == 'local') {
            return "/storage/$value";
        }
        return env('CLOUDFRONT_URL', 'SET_CLOUDFRONT_URL') . $value;
    }
}

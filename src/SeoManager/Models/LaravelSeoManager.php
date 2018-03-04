<?php

namespace Laravel\SeoManager\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LaravelSeoManager extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'page', 'title', 'meta_keywords', 'meta_description', 'image', 'url'];

}

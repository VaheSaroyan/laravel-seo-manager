<?php

namespace Laravel\SeoManager\Facades;

use Illuminate\Support\Facades\Facade;

class SeoManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seomanager';
    }
}

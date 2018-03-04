<?php

namespace Laravel\SeoManager;

use Illuminate\View\View;
use Laravel\SeoManager\Contracts\SeoLaravelContract;
use Laravel\SeoManager\Services\SeoService;

class SeoManager extends SeoService implements SeoLaravelContract
{

    public static function generateManager()
    {
        return view('seo-manager::index');

    }

    public static function seoGenarate($request)
    {
        parent::seoForAllPages($request->getRequestUri());

    }


}

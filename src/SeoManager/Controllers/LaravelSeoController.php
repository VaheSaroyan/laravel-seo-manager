<?php

namespace Laravel\SeoManager\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\SeoManager\Models\LaravelSeoManager;
use Laravel\SeoManager\Services\ImageServices;

class LaravelSeoController extends Controller
{
    public function store(Request $request)
    {
        $seoAllPages = LaravelSeoManager::updateOrCreate([
            'url'=>$request['url'],

        ],[
            'title'=>$request['title'],
            'meta_keywords'=>$request['meta_keywords'],
            'meta_description'=>$request['meta_description'],

        ]);
        if($request->file('image')){
            ImageServices::savePhoto($request['image'],$seoAllPages,'image');
        }
        return back();

    }
}

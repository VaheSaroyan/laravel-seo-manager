<?php

namespace Laravel\SeoManager\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\SeoManager\Models\LaravelSeoManager;

class LaravelSeoController extends Controller
{
    public function store(Request $request)
    {
        $seoAllPages = LaravelSeoManager::updateOrCreate([
            'url' => $request['url'],

        ], [
            'title' => $request['title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],

        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storePublicly('seoImages');
            $seoAllPages->image = $imagePath;
            $seoAllPages->save();
        }
        return back();

    }
}

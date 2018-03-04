<?php
Route::resource('laravelSeoManager', 'Laravel\\SeoManager\\Controllers\\LaravelSeoController');
Route::get('/storage/laravel-seo-tools/{filename}', function ($filename) {
    $path = storage_path() . '/laravel-seo-tools/' . $filename;
    $file = \Illuminate\Support\Facades\File::get($path);
    $type = \Illuminate\Support\Facades\File::mimeType($path);
    $response = \Illuminate\Support\Facades\Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('SeoManagerFile');
# Laravel Seo Manager
------------------------------
## Installation
### 1 - Dependency
The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:
```shell
composer require seomanager/laravel-seo-manager
```
> **Note**: If you are using Laravel 5.5, the steps 2 and 3, for providers and aliases, are unnecessaries. SeoManager supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

### 2 - Provider
You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        Laravel\\SeoManager\\Providers\\SeoManagerServiceProvider::class,
    ],
// file END ommited
```



### 3 - Facade

> Facades are not supported in Lumen.

In order to use the `SEOMeta` facade, you need to register it on the `config/app.php` file, you can do that the following way:

```php
// file START ommited
    'aliases' => [
        // other Facades ommited
       
             'LaravelSeo'=>Laravel\\SeoManager\\Facades\\SeoManager::class,
             
                 ],
// file END ommited
```


### 4 Configuration

#### Publish config

In your terminal type
```shell
php artisan vendor:publish
```

In `LaravelSeoManager.php` configuration file you can determine the properties of the default values and some behaviors.

#### LaravelSeoManager.php

- multi-languages default `false`
- multi-languages default `provider` *this data send type*
 and multi-languages default `controller` 


### Meta tags Generator
With **SEOMeta** you can create meta tags to the `head`

- 1 add `{!! SEO::generate(true) !!}` to site `head`

- 2 add `{!! SeoManager::generateManager() !!}` to site `body` *you can be shut seo manager in admin permission*
### EX
```blade
@if(Auth::user->hasRole() == 'admin')
{!! SeoManager::generateManager() !!}
@endif
```
- 3 usage in controller
```php
 public function index(Request $request)
    {
        SeoManager::seoGenarate($request);

        return view('home');
    }
```

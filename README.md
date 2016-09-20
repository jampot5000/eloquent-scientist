# Eloquent Scientist


Allows the [Scientist library](https://github.com/daylerees/scientist) to be used with the [Laravel PHP framework](https://laravel.com),
and adds the migrations/models for storing the resulting information with eloquent.

## Installation

Require the latest version of Eloquent Scientist using [Composer](https://getcomposer.org/).

    composer require jampot5000/eloquent-scientist

Next, add the service provider to the `providers` section of `config/app.php` in your Laravel project.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        
        Jampot5000\EloquentScientist\ServiceProvider::class,

    ],
    
];
```

Register the Facade within the `aliases` section of `config/app.php`.


```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,
        
        'Scientist' => Jampot5000\EloquentScientist\Facade::class,

    ],

];
```
Run the migrations

    php artisan migrate

You're good to go!

## Optional

You can publish the configuration file

        php artisan vendor:publish
        
This will allow you to configure the models used and add additional reporters

## Usage

You can access the Eloquent Scientist Laboratory through the `Scientist` facade.

```php
<?php

$value = Scientist::experiment('foo')
    ->control($controlCallback)
    ->trial('First trial.', $trialCallback)
    ->run();
```

Or, inject the Laboratory into a container resolved class or controller action.

```php
<?php

use Scientist\Laboratory;

class FooController extends Controller
{
    public function index(Laboratory $laboratory)
    {
        return $laboratory->experiment('foo')
            ->control(function() { ... })
            ->trial('First trial.', function() { ... })
            ->run();
    }
}
```

See the Scientist documentation for more information!

## Credit

Dayle Rees - For porting the Scientist Library to PHP, and for the original laravel package this idea came from.

## Todo
- [ ] Tests
- [ ] Views


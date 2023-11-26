<?php

namespace App\Providers;

use App\Models\Type;
use Illuminate\Support\ServiceProvider;

class TypesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('app.types', function () {
            return Type::all();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

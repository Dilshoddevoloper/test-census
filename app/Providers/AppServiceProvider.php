<?php

namespace App\Providers;

use App\Mixins\ResponseFactoryMixin;
use App\Observers\CitizenObserver;
use App\Observers\SurveyObserver;
use App\Survey;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::mixin(new ResponseFactoryMixin());
    }
}

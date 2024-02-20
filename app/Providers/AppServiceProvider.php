<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // this is for morph logic so we save a name of model in db instead  path model
        // Relation::enforceMorphMap([
        //     'post' => 'App\Models\Post',
        //     'video' => 'App\Models\Video',
        // ]);
    }
}

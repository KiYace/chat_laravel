<?php

namespace App\Providers;

use App\Http\Repository\Message\EloquentMessageRepository;
use App\Http\Repository\Message\MessageRepository;
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
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);

        $repositories = [
            [
                MessageRepository::class,
                EloquentMessageRepository::class
            ]
        ];

        foreach ($repositories as $repository) {
            app()->bind($repository[0], $repository[1]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

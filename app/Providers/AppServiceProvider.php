<?php

namespace App\Providers;

use App\Contracts\AuthInterface;
use App\Contracts\ValidatorInterface;
use App\Repositories\AuthRepository;
use App\Validators\AuthenticateValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // auth
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(ValidatorInterface::class, AuthenticateValidator::class);
        // auth
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

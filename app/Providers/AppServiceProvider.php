<?php

namespace App\Providers;

use App\Contracts\AuthInterface;
use App\Contracts\DestroyInterface;
use App\Contracts\IsLikeInterface;
use App\Contracts\StoreInterface;
use App\Contracts\StoreWithFileInterface;
use App\Contracts\UpdateFileInterface;
use App\Contracts\UpdateInterface;
use App\Contracts\UploadFileInterface;
use App\Contracts\ValidatorInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\ComunityCategoriesRepository;
use App\Repositories\FeedsRepository;
use App\Repositories\LikesRepository;
use App\Repositories\QuestionsRepository;
use App\Validators\AjaxValidator;
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
        $this->app->bind(ValidatorInterface::class, AjaxValidator::class);
        // auth
        // feed
        $this->app->bind(StoreInterface::class, FeedsRepository::class);
        $this->app->bind(StoreWithFileInterface::class, FeedsRepository::class);
        $this->app->bind(UpdateInterface::class, FeedsRepository::class);
        $this->app->bind(DestroyInterface::class, FeedsRepository::class);
        $this->app->bind(UploadFileInterface::class, FeedsRepository::class);
        $this->app->bind(UpdateFileInterface::class, FeedsRepository::class);
        // feed
        // like
        $this->app->bind(IsLikeInterface::class, LikesRepository::class);
        $this->app->bind(StoreInterface::class, LikesRepository::class);
        // like
        // comment
        $this->app->bind(StoreInterface::class, CommentsRepository::class);
        $this->app->bind(UpdateInterface::class, CommentsRepository::class);
        $this->app->bind(DestroyInterface::class, CommentsRepository::class);
        // comment
        // comunity categories
        $this->app->bind(StoreInterface::class, ComunityCategoriesRepository::class);
        $this->app->bind(UpdateInterface::class, ComunityCategoriesRepository::class);
        $this->app->bind(DestroyInterface::class, ComunityCategoriesRepository::class);
        $this->app->bind(UploadFileInterface::class, ComunityCategoriesRepository::class);
        $this->app->bind(UpdateFileInterface::class, ComunityCategoriesRepository::class);
        // comunity categories
        // questions
        $this->app->bind(StoreInterface::class, QuestionsRepository::class);
        $this->app->bind(UpdateInterface::class, QuestionsRepository::class);
        $this->app->bind(DestroyInterface::class, QuestionsRepository::class);
        // questions
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\interface\HeadOfFamilyRepositoryInterface;
use App\interface\UserRepositoryInterface;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\UserRepository;
use FamilyMemberRepository;
use FamilyMemberRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

use Cidenet\Api\Domain\Model\Employee\EmployeeRepositoryInterface;
use Cidenet\Api\Infrastructure\Persistence\Eloquent\Repository\EloquentEmployeeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EloquentEmployeeRepositoryInterface::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}

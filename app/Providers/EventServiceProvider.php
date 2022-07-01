<?php

declare(strict_types=1);

namespace App\Providers;

use Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator\EmployeeCreatorCommand;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator\EmployeeCreatorCommandHandler;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeRemover\EmployeeRemoverCommand;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeRemover\EmployeeRemoverCommandHandler;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater\EmployeeUpdaterCommand;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater\EmployeeUpdaterCommandHandler;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGet\EmployeeGetQuery;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGet\EmployeeGetQueryHandler;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList\EmployeeGetListQuery;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList\EmployeeGetListQueryHandler;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
        EmployeeGetQuery::class => [EmployeeGetQueryHandler::class],
        EmployeeGetListQuery::class => [EmployeeGetListQueryHandler::class],
        EmployeeCreatorCommand::class => [EmployeeCreatorCommandHandler::class],
        EmployeeUpdaterCommand::class => [EmployeeUpdaterCommandHandler::class],
        EmployeeRemoverCommand::class => [EmployeeRemoverCommandHandler::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

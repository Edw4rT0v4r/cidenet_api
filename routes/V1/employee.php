<?php

declare(strict_types=1);

use Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee\CreateEmployeeAction;
use Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee\DeleteEmployeeAction;
use Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee\GetEmployeeAction;
use Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee\GetEmployeeListAction;
use Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee\UpdateEmployeeAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {
    Route::get('employees', GetEmployeeListAction::class);
    Route::get('employees/{id}', GetEmployeeAction::class);
    Route::post('employees', CreateEmployeeAction::class);
    Route::match(['put', 'patch'], 'employees/{id}', UpdateEmployeeAction::class);
    Route::delete('employees/{id}', DeleteEmployeeAction::class);
});

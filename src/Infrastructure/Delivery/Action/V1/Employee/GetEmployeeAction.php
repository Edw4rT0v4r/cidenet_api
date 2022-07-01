<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee;

use App\Http\Controllers\Controller;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGet\EmployeeGetQuery;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Illuminate\Http\Request;

class GetEmployeeAction extends Controller
{
    public function __invoke(Request $request)
    {
        return event(new EmployeeGetQuery($request->{EmployeeId::COLUMN}))[0];
    }
}

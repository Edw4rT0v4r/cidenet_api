<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee;

use App\Http\Controllers\Controller;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeCreator\EmployeeCreatorCommand;
use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateEmployeeAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $id = event(new EmployeeCreatorCommand(
            $request->{EmployeeFirstName::COLUMN} ?? '',
            $request->{EmployeeOtherName::COLUMN},
            $request->{EmployeeFirstSurname::COLUMN} ?? '',
            $request->{EmployeeSecondSurname::COLUMN} ?? '',
            $request->{EmployeeCountry::COLUMN} ?? '',
            $request->{EmployeeIdType::COLUMN} ?? '',
            $request->{EmployeeIdentificationNumber::COLUMN} ?? '',
            $request->{EmployeeAdmissionDate::COLUMN} ?? '',
            $request->{EmployeeArea::COLUMN} ?? ''
        ))[0];

        return response()->json([
            'employee' => ['id' => $id->value()],
            'message' => 'The employee has been create successfully',
        ], 201);
    }
}

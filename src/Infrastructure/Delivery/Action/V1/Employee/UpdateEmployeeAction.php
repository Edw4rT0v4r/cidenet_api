<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee;

use App\Http\Controllers\Controller;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeUpdater\EmployeeUpdaterCommand;
use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateEmployeeAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->{EmployeeId::COLUMN};

        EmployeeUpdaterCommand::dispatch(
            $id,
            $request->get(EmployeeFirstName::COLUMN, ''),
            $request->get(EmployeeOtherName::COLUMN),
            $request->get(EmployeeFirstSurname::COLUMN, ''),
            $request->get(EmployeeSecondSurname::COLUMN, ''),
            $request->get(EmployeeCountry::COLUMN, ''),
            $request->get(EmployeeIdType::COLUMN, ''),
            $request->get(EmployeeIdentificationNumber::COLUMN, ''),
            $request->get(EmployeeAdmissionDate::COLUMN, ''),
            $request->get(EmployeeArea::COLUMN, '')
        );

        return response()->json([
            'employee' => ['id' => $id],
            'message' => 'The employee has been updated successfully',
        ], 201);
    }
}

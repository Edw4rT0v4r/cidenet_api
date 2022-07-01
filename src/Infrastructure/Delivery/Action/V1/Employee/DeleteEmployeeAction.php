<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee;

use App\Http\Controllers\Controller;
use Cidenet\Api\Application\Command\V1\Employee\EmployeeRemover\EmployeeRemoverCommand;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteEmployeeAction extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->{EmployeeId::COLUMN};

        EmployeeRemoverCommand::dispatch($id);

        return response()->json([
            'employee' => ['id' => $id],
            'message' => 'The employee has been deleted successfully',
        ], 202);
    }
}

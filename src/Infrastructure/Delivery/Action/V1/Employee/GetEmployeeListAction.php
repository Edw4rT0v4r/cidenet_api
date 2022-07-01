<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Action\V1\Employee;

use App\Http\Controllers\Controller;
use Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList\EmployeeGetListQuery;
use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Collection\V1\JsonApiEmployeeCollection;
use Illuminate\Http\Request;

class GetEmployeeListAction extends Controller
{
    public function __invoke(Request $request): JsonApiEmployeeCollection
    {
        $limit = $request->limit ?? 10;

        return event(new EmployeeGetListQuery($request->filter ?? [], $request->sort ?? [], (int) $limit))[0];
    }
}

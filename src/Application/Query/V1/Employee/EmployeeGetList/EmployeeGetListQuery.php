<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeGetListQuery
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    private array $filter;
    private array $sort;
    private int $limit;

    public function __construct(array $filter, array $sort, int $limit)
    {
        $this->filter = $filter;
        $this->sort = $sort;
        $this->limit = $limit;
    }

    public function filter(): array
    {
        return $this->filter;
    }

    public function sort(): array
    {
        return $this->sort;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}

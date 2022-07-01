<?php

declare(strict_types=1);

namespace Cidenet\Api\Application\Query\V1\Employee\EmployeeGetList;

use Cidenet\Api\Domain\Model\Employee\EmployeeCriteria;
use Cidenet\Api\Domain\Shared\Exception\InvalidFilter;
use Cidenet\Api\Domain\Shared\Exception\InvalidSort;
use Cidenet\Api\Domain\Shared\Exception\InvalidSortDirection;

class EmployeeGetListQueryValidator
{
    private EmployeeCriteria $criteria;

    public function __construct(EmployeeCriteria $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @throws InvalidFilter
     * @throws InvalidSort
     * @throws InvalidSortDirection
     */
    public function validate(EmployeeGetListQuery $command)
    {
        return $this->criteria->query($command->filter(), $command->sort(), $command->limit());
    }
}

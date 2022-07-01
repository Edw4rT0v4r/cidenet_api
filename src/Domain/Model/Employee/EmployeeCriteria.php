<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Model\Employee;

use Cidenet\Api\Domain\Shared\Exception\InvalidFilter;
use Cidenet\Api\Domain\Shared\Exception\InvalidSort;
use Cidenet\Api\Domain\Shared\Exception\InvalidSortDirection;

class EmployeeCriteria
{
    private static array $sortDirections = ['asc', 'desc'];

    private static array $fieldToSearch = [
        EmployeeFirstName::COLUMN,
        EmployeeOtherName::COLUMN,
        EmployeeFirstSurname::COLUMN,
        EmployeeSecondSurname::COLUMN,
        EmployeeIdType::COLUMN,
        EmployeeIdentificationNumber::COLUMN,
        EmployeeCountry::COLUMN,
        EmployeeEmail::COLUMN,
        EmployeeStatus::COLUMN,
    ];

    private static array $fieldToSort = [
        EmployeeFirstName::COLUMN,
        EmployeeOtherName::COLUMN,
        EmployeeFirstSurname::COLUMN,
        EmployeeSecondSurname::COLUMN,
        EmployeeEmail::COLUMN,
        EmployeeCountry::COLUMN,
        EmployeeIdType::COLUMN,
        EmployeeIdentificationNumber::COLUMN,
        EmployeeAdmissionDate::COLUMN,
        EmployeeArea::COLUMN,
        EmployeeStatus::COLUMN,
        Employee::COLUMN_CREATE_AT,
    ];

    private EmployeeRepositoryInterface $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws InvalidFilter
     * @throws InvalidSort
     * @throws InvalidSortDirection
     */
    public function query(array $filters, array $sorts, int $limit)
    {
        $this->validateFilters($filters);
        $this->validateSorts($sorts);

        $query = $this->repository->eloquentEmployeeModel()::latest();
        $this->addFilters($query, $filters);
        $this->addSorts($query, $sorts);

        return $query->paginate($limit);
    }

    /**
     * @throws InvalidFilter
     */
    private function validateFilters(array $filters): void
    {
        foreach ($filters as $filter => $value) {
            if (!in_array($filter, self::$fieldToSearch, true)) {
                throw new InvalidFilter($filter);
            }
        }
    }

    /**
     * @throws InvalidSort
     * @throws InvalidSortDirection
     */
    private function validateSorts(array $sorts): void
    {
        foreach ($sorts as $sort => $value) {
            if (!in_array($sort, self::$fieldToSort, true)) {
                throw new InvalidSort($sort);
            }
            if (!in_array($value, self::$sortDirections, true)) {
                throw new InvalidSortDirection($sort);
            }
        }
    }

    private function addFilters($query, array $filters): void
    {
        foreach ($filters as $filter => $value) {
            $values = array_filter(explode(';', $value));

            if (count($values) > 1) {
                $query->where(function ($subQuery) use ($filter, $values) {
                    foreach ($values as $value) {
                        $subQuery->orWhere($filter, 'LIKE', "%{$value}%");
                    }
                });

                continue;
            }

            $query->where($filter, 'LIKE', "%{$values[0]}%");
        }
    }

    private function addSorts($query, array $sorts): void
    {
        foreach ($sorts as $sort => $value) {
            $query->orderBy($sort, $value);
        }
    }
}

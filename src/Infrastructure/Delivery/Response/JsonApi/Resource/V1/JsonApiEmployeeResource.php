<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Resource\V1;

use App\Models\Employee as EloquentEmployeeModel;
use Cidenet\Api\Domain\Model\Employee\Employee;
use Cidenet\Api\Domain\Model\Employee\EmployeeAdmissionDate;
use Cidenet\Api\Domain\Model\Employee\EmployeeArea;
use Cidenet\Api\Domain\Model\Employee\EmployeeCountry;
use Cidenet\Api\Domain\Model\Employee\EmployeeEmail;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstName;
use Cidenet\Api\Domain\Model\Employee\EmployeeFirstSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeId;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdentificationNumber;
use Cidenet\Api\Domain\Model\Employee\EmployeeIdType;
use Cidenet\Api\Domain\Model\Employee\EmployeeOtherName;
use Cidenet\Api\Domain\Model\Employee\EmployeeSecondSurname;
use Cidenet\Api\Domain\Model\Employee\EmployeeStatus;
use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonApiEmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        if (is_a($this->resource, EloquentEmployeeModel::class)) {
            return [
                EmployeeId::COLUMN => $this->{EmployeeId::COLUMN},
                EmployeeFirstName::COLUMN => $this->{EmployeeFirstName::COLUMN},
                EmployeeOtherName::COLUMN => $this->{EmployeeOtherName::COLUMN},
                EmployeeFirstSurname::COLUMN => $this->{EmployeeFirstSurname::COLUMN},
                EmployeeSecondSurname::COLUMN => $this->{EmployeeSecondSurname::COLUMN},
                EmployeeEmail::COLUMN => $this->{EmployeeEmail::COLUMN},
                EmployeeCountry::COLUMN => $this->{EmployeeCountry::COLUMN},
                EmployeeIdType::COLUMN => $this->{EmployeeIdType::COLUMN},
                EmployeeIdentificationNumber::COLUMN => $this->{EmployeeIdentificationNumber::COLUMN},
                EmployeeAdmissionDate::COLUMN => $this->{EmployeeAdmissionDate::COLUMN},
                EmployeeArea::COLUMN => $this->{EmployeeArea::COLUMN},
                EmployeeStatus::COLUMN => $this->{EmployeeStatus::COLUMN},
                Employee::COLUMN_CREATE_AT => $this->{Employee::COLUMN_CREATE_AT}->format(DateValueObject::FORMAT_TIME),
                Employee::COLUMN_UPDATE_AT => $this->{Employee::COLUMN_UPDATE_AT}->format(DateValueObject::FORMAT_TIME),
            ];
        }

        return $this->__toArray();
    }
}

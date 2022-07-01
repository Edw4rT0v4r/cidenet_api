<?php

declare(strict_types=1);

namespace Cidenet\Api\Domain\Shared\Model;

use Cidenet\Api\Domain\Shared\ValueObject\DateValueObject;

trait TimeAwareTrait
{
    protected DateValueObject $createdAt;

    protected ?DateValueObject $updatedAt = null;

    public function createdAt(): DateValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateValueObject
    {
        return $this->updatedAt;
    }

    public function setCreatedAt(DateValueObject $dateValueObject): void
    {
        $this->createdAt = $dateValueObject;
    }

    public function setUpdateAt(DateValueObject $dateValueObject): void
    {
        $this->updatedAt = $dateValueObject;
    }
}

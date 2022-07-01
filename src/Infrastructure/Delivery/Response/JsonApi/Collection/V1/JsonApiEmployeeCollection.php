<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Collection\V1;

use Cidenet\Api\Infrastructure\Delivery\Response\JsonApi\Resource\V1\JsonApiEmployeeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JsonApiEmployeeCollection extends ResourceCollection
{
    public $collects = JsonApiEmployeeResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'meta' => ['organization' => 'cedenet'],
            'type' => 'employees',
        ];
    }
}

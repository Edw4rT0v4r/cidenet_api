<?php

declare(strict_types=1);

namespace Cidenet\Api\Infrastructure\Persistence\Type;

use Illuminate\Support\Str;

trait Uuid
{
    /**
     * Override the getIncrementing() function to return false to tell
     * Laravel that the identifier does not auto increment (it's a string).
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Tell laravel that the key type is a string, not an integer.
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (null === $model->getKey()) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }
}

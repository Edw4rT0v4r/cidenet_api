<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class Uppercase implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }
    }
}

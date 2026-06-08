<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Valida URLs http/https de forma permissiva (fragmentos #, query strings, etc.).
 * A regra nativa `url` do Laravel rejeita casos válidos no mundo real,
 * como https://example.com/path##anchor.
 */
class HttpUrl implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (! is_string($value) || ! preg_match('/^https?:\/\/.+/i', $value)) {
            $fail('Informe uma URL válida começando com http:// ou https://.');
        }
    }
}

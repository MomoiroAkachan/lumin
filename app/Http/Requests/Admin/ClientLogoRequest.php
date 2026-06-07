<?php

namespace App\Http\Requests\Admin;

use App\Rules\HttpUrl;
use Illuminate\Foundation\Http\FormRequest;

class ClientLogoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, array<int, mixed>|string>
     */
    public function rules(): array
    {
        $logoRule = $this->isMethod('post') ? ['required', 'image', 'max:2048'] : ['nullable', 'image', 'max:2048'];

        return [
            'name' => ['required', 'string', 'max:120'],
            'logo' => $logoRule,
            'link' => ['nullable', 'string', 'max:255', new HttpUrl],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}

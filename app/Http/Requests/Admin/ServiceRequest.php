<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
        $serviceId = $this->route('service')?->id;

        return [
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:160', Rule::unique('services', 'slug')->ignore($serviceId)],
            'icon' => ['nullable', 'string', 'max:60'],
            'icon_file' => ['nullable', 'image', 'max:2048'],
            'short_description' => ['required', 'string', 'max:255'],
            'full_text' => ['nullable', 'string'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}

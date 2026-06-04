<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        $imageRule = $this->isMethod('post') ? ['required', 'image', 'max:4096'] : ['nullable', 'image', 'max:4096'];

        return [
            'title' => ['required', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => $imageRule,
            'cta_label' => ['nullable', 'string', 'max:60'],
            'cta_url' => ['nullable', 'url', 'max:255'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryImageRequest extends FormRequest
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
            'image' => $imageRule,
            'caption' => ['nullable', 'string', 'max:160'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}

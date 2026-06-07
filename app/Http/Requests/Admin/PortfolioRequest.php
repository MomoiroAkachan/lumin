<?php

namespace App\Http\Requests\Admin;

use App\Rules\HttpUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
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
        $portfolioId = $this->route('portfolio')?->id;
        $coverRule = $this->isMethod('post') ? ['required', 'image', 'max:4096'] : ['nullable', 'image', 'max:4096'];

        return [
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:170', Rule::unique('portfolios', 'slug')->ignore($portfolioId)],
            'cover_image' => $coverRule,
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255', new HttpUrl],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:4096'],
        ];
    }
}

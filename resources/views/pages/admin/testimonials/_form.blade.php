@php $testimonial = $testimonial ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Nome *</label>
        <input type="text" name="name" required value="{{ old('name', $testimonial?->name) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Cargo / Empresa</label>
        <input type="text" name="role_company" value="{{ old('role_company', $testimonial?->role_company) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <x-admin.image-upload
        name="photo"
        label="Foto do cliente"
        :optional="true"
        :preview-url="$testimonial?->photo_path ? media_url($testimonial->photo_path) : null"
        hint="Foto quadrada ou retrato. Máx. 2 MB."
    />
    <div>
        <label class="block text-sm font-medium mb-1">Avaliação (1–5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial?->rating) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Depoimento *</label>
        <textarea name="content" required rows="5" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('content', $testimonial?->content) }}</textarea>
    </div>
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="t_active" {{ old('is_active', $testimonial?->is_active ?? true) ? 'checked' : '' }}>
        <label for="t_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

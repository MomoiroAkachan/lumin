@php $banner = $banner ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Título *</label>
        <input type="text" name="title" required maxlength="150"
               value="{{ old('title', $banner?->title) }}"
               class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Subtítulo</label>
        <input type="text" name="subtitle" maxlength="255"
               value="{{ old('subtitle', $banner?->subtitle) }}"
               class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Texto do botão (CTA)</label>
        <input type="text" name="cta_label" maxlength="60"
               value="{{ old('cta_label', $banner?->cta_label) }}"
               class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">URL do botão</label>
        <input type="url" name="cta_url" maxlength="255"
               value="{{ old('cta_url', $banner?->cta_url) }}"
               class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Ordem de exibição</label>
        <input type="number" name="position" min="0"
               value="{{ old('position', $banner?->position ?? 0) }}"
               class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
    </div>

    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" id="is_active" name="is_active" value="1"
               {{ old('is_active', $banner?->is_active ?? true) ? 'checked' : '' }}
               class="rounded">
        <label for="is_active" class="text-sm">Ativo (visível no site)</label>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">
            Imagem {{ $banner ? '(deixe em branco para manter a atual)' : '*' }}
        </label>
        <input type="file" name="image" accept="image/*"
               class="w-full text-sm">
        @if($banner?->image_path)
            <div class="mt-2">
                <img src="{{ media_url($banner->image_path) }}"
                     class="h-24 rounded border border-gray-200">
            </div>
        @endif
        <p class="text-xs text-gray-500 mt-1">JPG, PNG ou WebP. Máx. 4MB.</p>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.banners.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm hover:opacity-90">
        Salvar
    </button>
</div>

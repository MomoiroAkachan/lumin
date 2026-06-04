@php $service = $service ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Título *</label>
        <input type="text" name="title" required value="{{ old('title', $service?->title) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Slug (deixe vazio para gerar)</label>
        <input type="text" name="slug" value="{{ old('slug', $service?->slug) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ícone (nome lucide/heroicon)</label>
        <input type="text" name="icon" value="{{ old('icon', $service?->icon) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagem do ícone (opcional)</label>
        <input type="file" name="icon_file" accept="image/*" class="w-full text-sm">
        @if($service?->icon_path)
            <img src="{{ media_url($service->icon_path) }}" class="h-12 mt-2 rounded">
        @endif
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descrição curta *</label>
        <input type="text" name="short_description" required maxlength="255" value="{{ old('short_description', $service?->short_description) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Texto completo</label>
        <textarea name="full_text" rows="6" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('full_text', $service?->full_text) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ordem</label>
        <input type="number" name="position" min="0" value="{{ old('position', $service?->position ?? 0) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="svc_active" {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }}>
        <label for="svc_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

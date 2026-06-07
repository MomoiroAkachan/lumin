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
    <x-admin.icon-picker name="icon" :value="$service?->icon" />
    <x-admin.image-upload
        name="icon_file"
        label="Imagem do ícone"
        :optional="true"
        :preview-url="$service?->icon_path ? media_url($service->icon_path) : null"
        hint="PNG ou SVG recomendado. Máx. 2 MB."
    />
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descrição curta *</label>
        <input type="text" name="short_description" required maxlength="255" value="{{ old('short_description', $service?->short_description) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Texto completo</label>
        <textarea name="full_text" rows="6" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('full_text', $service?->full_text) }}</textarea>
    </div>
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="svc_active" {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }}>
        <label for="svc_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

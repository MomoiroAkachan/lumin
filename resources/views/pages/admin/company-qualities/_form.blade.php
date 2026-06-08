@php $quality = $quality ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Título *</label>
        <input type="text" name="title" required value="{{ old('title', $quality?->title) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <x-admin.icon-picker name="icon" :value="$quality?->icon" />
    <x-admin.image-upload
        name="icon_file"
        label="Imagem do ícone"
        :optional="true"
        :preview-url="$quality?->icon_path ? media_url($quality->icon_path) : null"
        hint="PNG ou SVG recomendado. Máx. 2 MB."
    />
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descrição *</label>
        <textarea name="description" required rows="4" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('description', $quality?->description) }}</textarea>
    </div>
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="q_active" {{ old('is_active', $quality?->is_active ?? true) ? 'checked' : '' }}>
        <label for="q_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.company-qualities.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

@php $quality = $quality ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Título *</label>
        <input type="text" name="title" required value="{{ old('title', $quality?->title) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ícone (nome)</label>
        <input type="text" name="icon" value="{{ old('icon', $quality?->icon) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagem do ícone</label>
        <input type="file" name="icon_file" accept="image/*" class="w-full text-sm">
        @if($quality?->icon_path)<img src="{{ media_url($quality->icon_path) }}" class="h-12 mt-2 rounded">@endif
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descrição *</label>
        <textarea name="description" required rows="4" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('description', $quality?->description) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ordem</label>
        <input type="number" name="position" min="0" value="{{ old('position', $quality?->position ?? 0) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="q_active" {{ old('is_active', $quality?->is_active ?? true) ? 'checked' : '' }}>
        <label for="q_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.company-qualities.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

@php $image = $image ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Imagem {{ $image ? '(opcional)' : '*' }}</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm">
        @if($image?->image_path)<img src="{{ media_url($image->image_path) }}" class="h-32 mt-2 rounded">@endif
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Legenda</label>
        <input type="text" name="caption" value="{{ old('caption', $image?->caption) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ordem</label>
        <input type="number" name="position" min="0" value="{{ old('position', $image?->position ?? 0) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="g_active" {{ old('is_active', $image?->is_active ?? true) ? 'checked' : '' }}>
        <label for="g_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

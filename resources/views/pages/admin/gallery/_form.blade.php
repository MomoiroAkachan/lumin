@php $image = $image ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <x-admin.image-upload
        name="image"
        label="Imagem da galeria"
        :required="! $image"
        :optional="(bool) $image"
        :preview-url="$image?->image_path ? media_url($image->image_path) : null"
    />
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Legenda</label>
        <input type="text" name="caption" value="{{ old('caption', $image?->caption) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="g_active" {{ old('is_active', $image?->is_active ?? true) ? 'checked' : '' }}>
        <label for="g_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

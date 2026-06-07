@php $logo = $logo ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-1">Nome do cliente *</label>
        <input type="text" name="name" required value="{{ old('name', $logo?->name) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Link (opcional)</label>
        <input type="url" name="link" value="{{ old('link', $logo?->link) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <x-admin.image-upload
        name="logo"
        label="Logotipo do cliente"
        :required="! $logo"
        :optional="(bool) $logo"
        :preview-url="$logo?->logo_path ? media_url($logo->logo_path) : null"
        hint="PNG com fundo transparente recomendado. Máx. 2 MB."
    />
    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="cl_active" {{ old('is_active', $logo?->is_active ?? true) ? 'checked' : '' }}>
        <label for="cl_active" class="text-sm">Ativo</label>
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.client-logos.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

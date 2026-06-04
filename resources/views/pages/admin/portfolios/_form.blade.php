@php $portfolio = $portfolio ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Título *</label>
        <input type="text" name="title" required value="{{ old('title', $portfolio?->title) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $portfolio?->slug) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Link externo</label>
        <input type="url" name="link" value="{{ old('link', $portfolio?->link) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descrição</label>
        <textarea name="description" rows="5" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('description', $portfolio?->description) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagem de capa {{ $portfolio ? '(opcional)' : '*' }}</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full text-sm">
        @if($portfolio?->cover_image_path)
            <img src="{{ media_url($portfolio->cover_image_path) }}" class="h-20 mt-2 rounded">
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Galeria (múltiplas imagens)</label>
        <input type="file" name="gallery[]" accept="image/*" multiple class="w-full text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ordem</label>
        <input type="number" name="position" min="0" value="{{ old('position', $portfolio?->position ?? 0) }}" class="w-full rounded border border-gray-300 px-3 py-2">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" id="port_active" {{ old('is_active', $portfolio?->is_active ?? true) ? 'checked' : '' }}>
        <label for="port_active" class="text-sm">Ativo</label>
    </div>
</div>

@if($portfolio?->images?->isNotEmpty())
    <div class="mt-6">
        <h4 class="text-sm font-semibold mb-2">Imagens da galeria</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach($portfolio->images as $image)
                <div class="relative group">
                    <img src="{{ media_url($image->image_path) }}" class="rounded w-full h-32 object-cover">
                    <form action="{{ route('admin.portfolios.images.destroy', [$portfolio, $image]) }}" method="POST"
                          onsubmit="return confirm('Remover esta imagem?')"
                          class="absolute top-1 right-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100">×</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="flex items-center justify-end gap-3 mt-6 border-t pt-4">
    <a href="{{ route('admin.portfolios.index') }}" class="text-sm text-gray-600">Cancelar</a>
    <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar</button>
</div>

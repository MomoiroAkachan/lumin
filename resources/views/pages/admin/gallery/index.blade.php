@extends('layouts.admin')
@section('page-title', 'Galeria')
@section('admin-title', 'Galeria de fotos')
@section('admin-content')
    <x-admin.page-header title="Galeria de fotos">
        <x-slot:action>
            <a href="{{ route('admin.gallery.create') }}" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Nova imagem</a>
        </x-slot:action>
    </x-admin.page-header>

    @if($images->isEmpty())
        <p class="text-gray-500">Nenhuma imagem cadastrada.</p>
    @else
        <x-admin.reorder-hint />

        <div data-sortable-list data-resource="gallery" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($images as $image)
                <div data-sortable-item data-id="{{ $image->id }}" class="relative group bg-interface rounded border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <x-admin.sortable-handle-grid />
                    <img src="{{ media_url($image->image_path) }}" class="w-full h-32 object-cover">
                    <div class="p-2 text-xs">
                        <p class="truncate">{{ $image->caption ?: '—' }}</p>
                        <p class="text-gray-400">Ordem: <span data-sortable-position>{{ $image->position }}</span> · {{ $image->is_active ? 'Ativo' : 'Inativo' }}</p>
                    </div>
                    <div class="absolute top-1 right-1 flex gap-1 opacity-0 group-hover:opacity-100">
                        <a href="{{ route('admin.gallery.edit', $image) }}" class="bg-white text-xs px-2 py-1 rounded shadow">✎</a>
                        <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" onsubmit="return confirm('Remover?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-xs px-2 py-1 rounded shadow">×</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

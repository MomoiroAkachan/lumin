@extends('layouts.admin')

@section('page-title', 'Banners')
@section('admin-title', 'Banners')

@section('admin-content')
    <x-admin.page-header title="Banners" subtitle="Imagens rotativas exibidas no topo do site.">
        <x-slot:action>
            <a href="{{ route('admin.banners.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary text-primary-fg rounded text-sm hover:opacity-90">
                + Novo banner
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-surface text-left">
                <tr>
                    <th class="px-4 py-3 font-medium">Imagem</th>
                    <th class="px-4 py-3 font-medium">Título</th>
                    <th class="px-4 py-3 font-medium">Ordem</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($banners as $banner)
                    <tr>
                        <td class="px-4 py-3">
                            @if($banner->image_path)
                                <img src="{{ media_url($banner->image_path) }}"
                                     alt="{{ $banner->title }}"
                                     class="h-12 w-20 object-cover rounded">
                            @else
                                <span class="text-xs text-gray-400">sem imagem</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $banner->title }}</div>
                            @if($banner->subtitle)
                                <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($banner->subtitle, 80) }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $banner->position }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs
                                {{ $banner->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.banners.edit', $banner) }}"
                               class="text-primary hover:underline">Editar</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Remover este banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            Nenhum banner cadastrado ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $banners->links() }}
    </div>
@endsection

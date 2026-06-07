@extends('layouts.admin')
@section('page-title', 'Portfólio')
@section('admin-title', 'Portfólio')
@section('admin-content')
    <x-admin.page-header title="Portfólio" subtitle="Projetos exibidos no site.">
        <x-slot:action>
            <a href="{{ route('admin.portfolios.create') }}" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Novo projeto</a>
        </x-slot:action>
    </x-admin.page-header>

    @if($portfolios->isNotEmpty())
        <x-admin.reorder-hint />
    @endif

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-surface text-left">
                <tr>
                    <th class="px-2 py-3 w-10"></th>
                    <th class="px-4 py-3">Capa</th>
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Imagens</th>
                    <th class="px-4 py-3">Ordem</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody data-sortable-list data-resource="portfolios" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($portfolios as $portfolio)
                    <tr data-sortable-item data-id="{{ $portfolio->id }}">
                        <x-admin.sortable-handle />
                        <td class="px-4 py-3">
                            @if($portfolio->cover_image_path)
                                <img src="{{ media_url($portfolio->cover_image_path) }}" class="h-12 w-20 object-cover rounded">
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $portfolio->title }}</td>
                        <td class="px-4 py-3">{{ $portfolio->images_count }}</td>
                        <td class="px-4 py-3"><span data-sortable-position>{{ $portfolio->position }}</span></td>
                        <td class="px-4 py-3">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs {{ $portfolio->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $portfolio->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="text-primary hover:underline">Editar</a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="inline" onsubmit="return confirm('Remover?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">Nenhum projeto cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.admin')
@section('page-title', 'Qualidades')
@section('admin-title', 'Qualidades da empresa')
@section('admin-content')
    <x-admin.page-header title="Qualidades da empresa">
        <x-slot:action>
            <a href="{{ route('admin.company-qualities.create') }}" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Nova</a>
        </x-slot:action>
    </x-admin.page-header>

    @if($qualities->isNotEmpty())
        <x-admin.reorder-hint />
    @endif

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-surface text-left">
                <tr>
                    <th class="px-2 py-3 w-10"></th>
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Ordem</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody data-sortable-list data-resource="company-qualities" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($qualities as $quality)
                    <tr data-sortable-item data-id="{{ $quality->id }}">
                        <x-admin.sortable-handle />
                        <td class="px-4 py-3 font-medium">{{ $quality->title }}</td>
                        <td class="px-4 py-3"><span data-sortable-position>{{ $quality->position }}</span></td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded text-xs {{ $quality->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">{{ $quality->is_active ? 'Ativo' : 'Inativo' }}</span></td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.company-qualities.edit', $quality) }}" class="text-primary hover:underline">Editar</a>
                            <form action="{{ route('admin.company-qualities.destroy', $quality) }}" method="POST" class="inline" onsubmit="return confirm('Remover?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Remover</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhuma qualidade cadastrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

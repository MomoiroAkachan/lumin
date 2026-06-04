@extends('layouts.admin')

@section('page-title', 'Serviços')
@section('admin-title', 'Serviços')

@section('admin-content')
    <x-admin.page-header title="Serviços" subtitle="Serviços oferecidos pela empresa.">
        <x-slot:action>
            <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Novo serviço</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-surface text-left">
                <tr>
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Ordem</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($services as $service)
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $service->title }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $service->slug }}</td>
                        <td class="px-4 py-3">{{ $service->position }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $service->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-primary hover:underline">Editar</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Remover?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum serviço cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $services->links() }}</div>
@endsection

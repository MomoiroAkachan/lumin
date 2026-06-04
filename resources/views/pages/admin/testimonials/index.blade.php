@extends('layouts.admin')
@section('page-title', 'Depoimentos')
@section('admin-title', 'Depoimentos de clientes')
@section('admin-content')
    <x-admin.page-header title="Depoimentos de clientes">
        <x-slot:action>
            <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Novo</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-surface text-left">
                <tr><th class="px-4 py-3">Foto</th><th class="px-4 py-3">Nome</th><th class="px-4 py-3">Cargo / Empresa</th><th class="px-4 py-3">Avaliação</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Ações</th></tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($testimonials as $t)
                    <tr>
                        <td class="px-4 py-3">@if($t->photo_path)<img src="{{ media_url($t->photo_path) }}" class="h-10 w-10 rounded-full object-cover">@endif</td>
                        <td class="px-4 py-3 font-medium">{{ $t->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $t->role_company }}</td>
                        <td class="px-4 py-3">{{ $t->rating ? str_repeat('★', $t->rating) : '—' }}</td>
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded text-xs {{ $t->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">{{ $t->is_active ? 'Ativo' : 'Inativo' }}</span></td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-primary hover:underline">Editar</a>
                            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="inline" onsubmit="return confirm('Remover?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Remover</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Nenhum depoimento cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $testimonials->links() }}</div>
@endsection

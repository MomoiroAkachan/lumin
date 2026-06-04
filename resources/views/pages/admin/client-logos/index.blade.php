@extends('layouts.admin')
@section('page-title', 'Clientes')
@section('admin-title', 'Logotipos de clientes')
@section('admin-content')
    <x-admin.page-header title="Logotipos de clientes">
        <x-slot:action>
            <a href="{{ route('admin.client-logos.create') }}" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">+ Novo logo</a>
        </x-slot:action>
    </x-admin.page-header>

    @if($logos->isEmpty())
        <p class="text-gray-500">Nenhum logotipo cadastrado.</p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($logos as $logo)
                <div class="relative group bg-interface rounded border border-gray-200 dark:border-gray-700 p-4">
                    <img src="{{ media_url($logo->logo_path) }}" class="h-16 w-full object-contain">
                    <p class="text-xs text-center mt-2 truncate">{{ $logo->name }}</p>
                    <div class="absolute top-1 right-1 flex gap-1 opacity-0 group-hover:opacity-100">
                        <a href="{{ route('admin.client-logos.edit', $logo) }}" class="bg-white text-xs px-2 py-1 rounded shadow">✎</a>
                        <form action="{{ route('admin.client-logos.destroy', $logo) }}" method="POST" onsubmit="return confirm('Remover?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-xs px-2 py-1 rounded shadow">×</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $logos->links() }}</div>
    @endif
@endsection

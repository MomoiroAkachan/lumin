@extends('layouts.admin')
@section('page-title', 'Configurações')
@section('admin-title', 'Configurações do site')

@php
    $groupLabels = [
        'general' => 'Geral',
        'footer' => 'Rodapé',
        'contact' => 'Contato',
        'social' => 'Redes Sociais',
    ];
@endphp

@section('admin-content')
    <x-admin.page-header title="Configurações do site" subtitle="Informações exibidas no rodapé e no formulário de contato." />

    <form action="{{ route('admin.site-settings.update') }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        @foreach($settings as $group => $items)
            <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $groupLabels[$group] ?? ucfirst($group) }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($items as $setting)
                        <div class="{{ $setting->type === 'textarea' ? 'md:col-span-2' : '' }}">
                            <label class="block text-sm font-medium mb-1">{{ $setting->label ?? $setting->key }}</label>
                            @if($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" rows="3" class="w-full rounded border border-gray-300 px-3 py-2">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                            @else
                                <input type="{{ in_array($setting->type, ['text','email','tel','url']) ? $setting->type : 'text' }}"
                                       name="settings[{{ $setting->key }}]"
                                       value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                       class="w-full rounded border border-gray-300 px-3 py-2">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary text-primary-fg rounded text-sm">Salvar configurações</button>
        </div>
    </form>
@endsection

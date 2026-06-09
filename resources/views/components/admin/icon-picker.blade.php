@props([
    'name' => 'icon',
    'label' => 'Ícone',
    'value' => null,
])

@php
    $selected = old($name, $value);
    $icons = \App\Support\AdminIcons::all();
@endphp

<div {{ $attributes->merge(['class' => 'md:col-span-2']) }} data-icon-picker>
    <p class="block text-sm font-semibold text-foreground mb-2">{{ $label }}</p>
    <p class="text-xs text-gray-500 mb-3">Clique no ícone desejado. Você também pode enviar uma imagem personalizada abaixo.</p>

    <input type="hidden" name="{{ $name }}" value="{{ $selected }}" data-icon-input>

    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-2 p-4 rounded-xl border border-interface-bd bg-surface max-h-64 overflow-y-auto">
        @foreach($icons as $slug => $icon)
            <button
                type="button"
                title="{{ $icon['label'] }}"
                data-icon-option="{{ $slug }}"
                class="icon-picker-option flex flex-col items-center gap-1 p-2 rounded-lg border-2 transition
                       {{ $selected === $slug ? 'border-primary bg-primary/10 text-primary' : 'border-transparent hover:border-primary/30 hover:bg-white' }}"
            >
                <x-admin.icon :name="$slug" class="w-7 h-7"/>
                <span class="text-[10px] leading-tight text-center text-gray-500 truncate w-full">{{ $icon['label'] }}</span>
            </button>
        @endforeach
    </div>

    <div class="mt-2 flex items-center gap-3">
        <span class="text-xs text-gray-500">Selecionado:</span>
        <span data-icon-selected-label class="text-sm font-medium text-primary">
            {{ $selected && isset($icons[$selected]) ? $icons[$selected]['label'] : 'Nenhum' }}
        </span>
        <button type="button" data-icon-clear class="text-xs text-red-600 hover:underline {{ $selected ? '' : 'hidden' }}">
            Limpar ícone
        </button>
    </div>
</div>

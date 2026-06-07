@props(['name', 'class' => 'w-6 h-6'])

@php
    $icon = \App\Support\AdminIcons::find($name);
@endphp

@if($icon)
    <svg {{ $attributes->merge(['class' => $class]) }} fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon['path'] }}"/>
    </svg>
@endif

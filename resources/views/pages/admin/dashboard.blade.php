@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('admin-title', 'Dashboard')

@php
    $cards = [
        ['label' => 'Banners ativos', 'value' => \App\Models\Banner::where('is_active', true)->count(), 'route' => 'admin.banners.index'],
        ['label' => 'Serviços', 'value' => \App\Models\Service::where('is_active', true)->count(), 'route' => 'admin.services.index'],
        ['label' => 'Projetos no portfólio', 'value' => \App\Models\Portfolio::where('is_active', true)->count(), 'route' => 'admin.portfolios.index'],
        ['label' => 'Depoimentos', 'value' => \App\Models\Testimonial::where('is_active', true)->count(), 'route' => 'admin.testimonials.index'],
        ['label' => 'Mensagens novas', 'value' => \App\Models\ContactMessage::where('status', 'new')->count(), 'route' => 'admin.contact-messages.index'],
    ];
@endphp

@section('admin-content')
    <x-admin.page-header
        title="Visão geral"
        subtitle="Resumo do conteúdo publicado no site."
    />

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        @foreach($cards as $card)
            <a href="{{ route($card['route']) }}"
               class="block bg-interface rounded-lg border border-interface-bd p-4 hover:shadow-md transition">
                <p class="text-xs uppercase tracking-wider text-gray-500">{{ $card['label'] }}</p>
                <p class="text-3xl font-semibold mt-2 text-primary">{{ $card['value'] }}</p>
            </a>
        @endforeach
    </div>
@endsection

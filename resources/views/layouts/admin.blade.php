@extends('layouts.app')

@push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin-reorder-url" content="{{ route('admin.reorder') }}">
@endpush

@php
    $navItems = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => '◧'],
        ['route' => 'admin.banners.index', 'label' => 'Banners', 'icon' => '▦'],
        ['route' => 'admin.services.index', 'label' => 'Serviços', 'icon' => '⚙'],
        ['route' => 'admin.portfolios.index', 'label' => 'Portfólio', 'icon' => '✦'],
        ['route' => 'admin.company-qualities.index', 'label' => 'Qualidades', 'icon' => '✓'],
        ['route' => 'admin.gallery.index', 'label' => 'Galeria', 'icon' => '▣'],
        ['route' => 'admin.client-logos.index', 'label' => 'Clientes', 'icon' => '◉'],
        ['route' => 'admin.testimonials.index', 'label' => 'Depoimentos', 'icon' => '❝'],
        ['route' => 'admin.contact-messages.index', 'label' => 'Mensagens', 'icon' => '✉'],
        ['route' => 'admin.site-settings.index', 'label' => 'Configurações', 'icon' => '⚙'],
    ];
@endphp

@section('page-content')
    <div class="h-screen bg-background text-foreground">

        {{-- HEADER FIXO --}}
        <header class="h-14 bg-interface text-interface-fg border-b border-interface-bd
                   px-8 flex items-center justify-between sticky top-0 z-20">
            <div>
                <a href="{{ route('home') }}" class="text-lg font-semibold text-primary">
                    {{ config('app.name') }}
                </a>
                <p class="text-xs text-gray-500">Painel administrativo</p>
            </div>

            <h1 class="text-lg font-semibold">@yield('admin-title')</h1>

            <div class="text-sm text-gray-500">
                {{ auth()->user()?->name }}
            </div>
        </header>

        {{-- CONTEÚDO --}}
        <div class="flex h-[calc(100vh-3.5rem)]">

            {{-- SIDEBAR FIXA --}}
            <aside class="w-64 bg-interface border-r border-interface-bd flex flex-col">
                <nav class="flex-1 px-3 py-4 space-y-1">
                    @foreach($navItems as $item)
                                @php
                                    $active =
                                        request()->routeIs($item['route']) ||
                                        request()->routeIs(str_replace('.index', '.*', $item['route']));
                                @endphp

                                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-3 py-2 rounded text-sm transition
                                       {{ $active
                        ? 'bg-primary text-primary-fg'
                        : 'hover:bg-surface text-interface-fg' }}">
                                    <span class="text-base leading-none">{{ $item['icon'] }}</span>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                    @endforeach
                </nav>

                <div class="border-t border-zinc-200/25">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-danger hover:bg-danger hover:text-danger-fg transition cursor-pointer">
                            Sair
                        </button>
                    </form>
                </div>
            </aside>

            {{-- MAIN COM SCROLL --}}
            <main class="flex-1 overflow-y-auto bg-surface p-6">
                <x-admin.flash />
                @yield('admin-content')
            </main>

        </div>
    </div>
@endsection
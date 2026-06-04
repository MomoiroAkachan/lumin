@extends('layouts.app')

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
    <div class="flex min-h-screen bg-background text-foreground">
        <aside class="hidden md:flex md:flex-col w-64 bg-interface border-r border-gray-200 dark:border-gray-700">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('home') }}" class="text-lg font-semibold text-primary">
                    {{ config('app.name') }}
                </a>
                <p class="text-xs text-gray-500">Painel administrativo</p>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                @foreach($navItems as $item)
                    @php $active = request()->routeIs($item['route']) || request()->routeIs(str_replace('.index', '.*', $item['route'])); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2 rounded text-sm transition
                              {{ $active ? 'bg-primary text-primary-fg' : 'hover:bg-surface text-interface-fg' }}">
                        <span class="text-base leading-none">{{ $item['icon'] }}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="px-3 py-3 border-t border-gray-200 dark:border-gray-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left block px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded">
                        Sair
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-interface border-b border-gray-200 dark:border-gray-700 px-6 py-3 flex items-center justify-between">
                <h1 class="text-lg font-semibold">@yield('admin-title')</h1>
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span>{{ auth()->user()?->name }}</span>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-y-auto">
                <x-admin.flash />
                @yield('admin-content')
            </main>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('page-title', 'Início')

@section('page-content')
    @include('pages.landing.partials.navbar')

    <main>
        @include('pages.landing.partials.banner', ['banners' => $banners])
        @include('pages.landing.partials.services', ['services' => $services])
        @include('pages.landing.partials.portfolios', ['portfolios' => $portfolios])
        @include('pages.landing.partials.qualities', ['qualities' => $qualities])
        @include('pages.landing.partials.gallery', ['gallery' => $gallery])
        @include('pages.landing.partials.clients', ['logos' => $clientLogos])
        @include('pages.landing.partials.testimonials', ['testimonials' => $testimonials])
        @include('pages.landing.partials.contact', ['services' => $services])
    </main>

    @include('pages.landing.partials.footer', ['settings' => $settings])
@endsection

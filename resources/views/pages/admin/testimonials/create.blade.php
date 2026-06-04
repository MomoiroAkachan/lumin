@extends('layouts.admin')
@section('page-title', 'Novo depoimento')
@section('admin-title', 'Depoimentos')
@section('admin-content')
    <x-admin.page-header title="Novo depoimento" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.testimonials._form')
        </form>
    </div>
@endsection

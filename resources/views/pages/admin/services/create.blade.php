@extends('layouts.admin')
@section('page-title', 'Novo serviço')
@section('admin-title', 'Serviços')
@section('admin-content')
    <x-admin.page-header title="Novo serviço" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.services._form')
        </form>
    </div>
@endsection

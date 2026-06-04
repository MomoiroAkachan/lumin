@extends('layouts.admin')
@section('page-title', 'Novo logo')
@section('admin-title', 'Clientes')
@section('admin-content')
    <x-admin.page-header title="Novo logo de cliente" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.client-logos._form')
        </form>
    </div>
@endsection

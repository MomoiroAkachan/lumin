@extends('layouts.admin')
@section('page-title', 'Editar logo')
@section('admin-title', 'Clientes')
@section('admin-content')
    <x-admin.page-header title="Editar logo" subtitle="{{ $logo->name }}" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.client-logos.update', $logo) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.client-logos._form', ['logo' => $logo])
        </form>
    </div>
@endsection

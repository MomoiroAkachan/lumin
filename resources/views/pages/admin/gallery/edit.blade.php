@extends('layouts.admin')
@section('page-title', 'Editar imagem')
@section('admin-title', 'Galeria')
@section('admin-content')
    <x-admin.page-header title="Editar imagem" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.gallery.update', $image) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.gallery._form', ['image' => $image])
        </form>
    </div>
@endsection

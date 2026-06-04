@extends('layouts.admin')
@section('page-title', 'Nova imagem')
@section('admin-title', 'Galeria')
@section('admin-content')
    <x-admin.page-header title="Nova imagem da galeria" />
    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.gallery._form')
        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('page-title', 'Editar banner')
@section('admin-title', 'Banners')

@section('admin-content')
    <x-admin.page-header
        title="Editar banner"
        subtitle="{{ $banner->title }}"
    />

    <div class="bg-interface rounded-lg border border-gray-200 dark:border-gray-700 p-6">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('pages.admin.banners._form', ['banner' => $banner])
        </form>
    </div>
@endsection

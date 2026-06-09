@extends('layouts.admin')

@section('page-title', 'Novo banner')
@section('admin-title', 'Banners')

@section('admin-content')
    <x-admin.page-header title="Novo banner" subtitle="Adicione uma imagem destacada no topo do site." />

    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.banners._form')
        </form>
    </div>
@endsection

@extends('layouts.admin')
@section('page-title', 'Editar serviço')
@section('admin-title', 'Serviços')
@section('admin-content')
    <x-admin.page-header title="Editar serviço" subtitle="{{ $service->title }}" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.services._form', ['service' => $service])
        </form>
    </div>
@endsection

@extends('layouts.admin')
@section('page-title', 'Editar qualidade')
@section('admin-title', 'Qualidades')
@section('admin-content')
    <x-admin.page-header title="Editar qualidade" subtitle="{{ $quality->title }}" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.company-qualities.update', $quality) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.company-qualities._form', ['quality' => $quality])
        </form>
    </div>
@endsection

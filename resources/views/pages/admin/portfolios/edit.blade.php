@extends('layouts.admin')
@section('page-title', 'Editar projeto')
@section('admin-title', 'Portfólio')
@section('admin-content')
    <x-admin.page-header title="Editar projeto" subtitle="{{ $portfolio->title }}" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.portfolios._form', ['portfolio' => $portfolio])
        </form>
    </div>
@endsection

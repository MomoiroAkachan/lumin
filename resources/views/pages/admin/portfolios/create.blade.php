@extends('layouts.admin')
@section('page-title', 'Novo projeto')
@section('admin-title', 'Portfólio')
@section('admin-content')
    <x-admin.page-header title="Novo projeto" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.portfolios._form')
        </form>
    </div>
@endsection

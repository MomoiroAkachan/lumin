@extends('layouts.admin')
@section('page-title', 'Nova qualidade')
@section('admin-title', 'Qualidades')
@section('admin-content')
    <x-admin.page-header title="Nova qualidade" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.company-qualities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('pages.admin.company-qualities._form')
        </form>
    </div>
@endsection

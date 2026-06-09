@extends('layouts.admin')
@section('page-title', 'Editar depoimento')
@section('admin-title', 'Depoimentos')
@section('admin-content')
    <x-admin.page-header title="Editar depoimento" subtitle="{{ $testimonial->name }}" />
    <div class="bg-interface rounded-lg border border-interface-bd  p-6">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('pages.admin.testimonials._form', ['testimonial' => $testimonial])
        </form>
    </div>
@endsection

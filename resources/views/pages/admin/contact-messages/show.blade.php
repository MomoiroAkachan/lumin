@extends('layouts.admin')
@section('page-title', 'Mensagem')
@section('admin-title', 'Mensagem de contato')
@section('admin-content')
    <x-admin.page-header title="Mensagem #{{ $message->id }}" subtitle="Recebida em {{ $message->created_at?->format('d/m/Y H:i') }}">
        <x-slot:action>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-gray-600 hover:underline">← Voltar</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="bg-interface rounded-lg border border-interface-bd  p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Nome:</span> <strong>{{ $message->name }}</strong></div>
            <div><span class="text-gray-500">E-mail:</span> <a href="mailto:{{ $message->email }}" class="text-primary hover:underline">{{ $message->email }}</a></div>
            <div><span class="text-gray-500">Telefone:</span> {{ $message->phone ?? '—' }}</div>
            <div><span class="text-gray-500">Assunto:</span> {{ $message->subject ?? '—' }}</div>
            <div><span class="text-gray-500">Serviço:</span> {{ $message->service?->title ?? '—' }}</div>
            <div><span class="text-gray-500">Status:</span> {{ $message->status }}</div>
        </div>

        <div class="border-t pt-4">
            <h4 class="text-sm font-semibold mb-2">Mensagem</h4>
            <p class="whitespace-pre-wrap text-sm">{{ $message->message }}</p>
        </div>

        <div class="border-t pt-4 text-xs text-gray-500">
            IP: {{ $message->ip_address ?? '—' }} · UA: {{ $message->user_agent ?? '—' }}
        </div>

        <div class="flex justify-end gap-2 border-t pt-4">
            <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Remover mensagem?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded text-sm">Remover</button>
            </form>
        </div>
    </div>
@endsection

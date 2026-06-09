@extends('layouts.admin')
@section('page-title', 'Mensagens')
@section('admin-title', 'Mensagens de contato')
@section('admin-content')
    <x-admin.page-header title="Mensagens recebidas" subtitle="Envios do formulário de contato do site." />

    <div class="mb-4 flex items-center gap-2 text-sm">
        <span>Filtrar:</span>
        <a href="{{ route('admin.contact-messages.index') }}" class="{{ ! request('status') ? 'font-semibold text-primary' : 'text-gray-500' }}">Todas</a>
        <a href="?status=new" class="{{ request('status') === 'new' ? 'font-semibold text-primary' : 'text-gray-500' }}">Novas</a>
        <a href="?status=read" class="{{ request('status') === 'read' ? 'font-semibold text-primary' : 'text-gray-500' }}">Lidas</a>
        <a href="?status=replied" class="{{ request('status') === 'replied' ? 'font-semibold text-primary' : 'text-gray-500' }}">Respondidas</a>
    </div>

    <div class="bg-interface rounded-lg border border-interface-bd  overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:border-dvide-bd text-sm">
            <thead class="bg-surface text-left">
                <tr><th class="px-4 py-3">Status</th><th class="px-4 py-3">Nome</th><th class="px-4 py-3">E-mail</th><th class="px-4 py-3">Assunto</th><th class="px-4 py-3">Serviço</th><th class="px-4 py-3">Recebida em</th><th class="px-4 py-3"></th></tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:border-dvide-bd">
                @forelse($messages as $m)
                    <tr class="{{ $m->status === 'new' ? 'bg-yellow-50' : '' }}">
                        <td class="px-4 py-3"><span class="inline-flex px-2 py-0.5 rounded text-xs bg-gray-100">{{ $m->status }}</span></td>
                        <td class="px-4 py-3 font-medium">{{ $m->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $m->email }}</td>
                        <td class="px-4 py-3">{{ $m->subject ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $m->service?->title ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $m->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.contact-messages.show', $m) }}" class="text-primary hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">Nenhuma mensagem.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $messages->links() }}</div>
@endsection

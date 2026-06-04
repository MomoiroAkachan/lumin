<x-mail::message>
# Novo contato recebido pelo site

**Nome:** {{ $message->name }}
**E-mail:** {{ $message->email }}
**Telefone:** {{ $message->phone ?? '—' }}
**Assunto:** {{ $message->subject ?? '—' }}
@if($message->service)
**Serviço:** {{ $message->service->title }}
@endif

---

{{ $message->message }}

---

<small>Recebido em {{ $message->created_at?->format('d/m/Y H:i') }} de {{ $message->ip_address ?? 'IP desconhecido' }}.</small>
</x-mail::message>

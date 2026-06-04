<?php

use App\Jobs\SendContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\Service;
use Illuminate\Support\Facades\Queue;

it('persiste a mensagem e despacha o job de notificação', function () {
    Queue::fake();

    $service = Service::factory()->create();

    $response = $this->post(route('contact.store'), [
        'name' => 'Maria Souza',
        'email' => 'maria@example.com',
        'phone' => '+55 11 99999-0000',
        'subject' => 'Quero um orçamento',
        'message' => 'Preciso de uma solução para a minha empresa.',
        'service_id' => $service->id,
    ]);

    $response
        ->assertRedirect()
        ->assertSessionHas('contact-sent');

    expect(ContactMessage::count())->toBe(1);

    $message = ContactMessage::first();
    expect($message->status)->toBe(ContactMessage::STATUS_NEW)
        ->and($message->service_id)->toBe($service->id);

    Queue::assertPushed(SendContactMessageNotification::class, function ($job) use ($message) {
        return $job->contactMessage->is($message);
    });
});

it('rejeita envio quando o honeypot está preenchido', function () {
    Queue::fake();

    $response = $this->post(route('contact.store'), [
        'name' => 'Spammer',
        'email' => 'spam@example.com',
        'message' => 'spam content',
        'website' => 'http://spam.example.com',
    ]);

    $response->assertSessionHasErrors('website');
    expect(ContactMessage::count())->toBe(0);
    Queue::assertNothingPushed();
});

it('valida os campos obrigatórios', function () {
    $this->post(route('contact.store'), [])
        ->assertSessionHasErrors(['name', 'email', 'message']);

    expect(ContactMessage::count())->toBe(0);
});

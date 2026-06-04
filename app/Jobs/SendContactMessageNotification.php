<?php

namespace App\Jobs;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Envia o e-mail de notificação de novo contato. Mantido em fila pra não
 * travar a request do formulário público.
 */
class SendContactMessageNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(public ContactMessage $contactMessage) {}

    public function handle(): void
    {
        $recipient = config('mail.contact_notification_address')
            ?? config('mail.from.address');

        if (! $recipient) {
            Log::warning('Contact notification recipient is not configured.', [
                'message_id' => $this->contactMessage->id,
            ]);

            return;
        }

        Mail::to($recipient)->send(new ContactMessageReceived($this->contactMessage));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactMessageRequest;
use App\Jobs\SendContactMessageNotification;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(ContactMessageRequest $request): RedirectResponse
    {
        $contactMessage = ContactMessage::create([
            ...$request->safe()->except(['website']),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => ContactMessage::STATUS_NEW,
        ]);

        SendContactMessageNotification::dispatch($contactMessage);

        return redirect()
            ->route('home')
            ->with('contact-sent', true)
            ->withFragment('contato');
    }
}

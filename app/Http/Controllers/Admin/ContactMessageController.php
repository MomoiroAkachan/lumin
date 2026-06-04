<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->with('service:id,title')
            ->when($request->string('status')->isNotEmpty(), fn ($q) => $q->where('status', $request->string('status')))
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('pages.admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        if ($contactMessage->status === ContactMessage::STATUS_NEW) {
            $contactMessage->update([
                'status' => ContactMessage::STATUS_READ,
                'read_at' => now(),
            ]);
        }

        $contactMessage->load('service:id,title');

        return view('pages.admin.contact-messages.show', ['message' => $contactMessage]);
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Mensagem removida.');
    }
}

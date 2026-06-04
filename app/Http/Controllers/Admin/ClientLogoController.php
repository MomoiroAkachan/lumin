<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientLogoRequest;
use App\Models\ClientLogo;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientLogoController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $logos = ClientLogo::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(20);

        return view('pages.admin.client-logos.index', compact('logos'));
    }

    public function create(): View
    {
        return view('pages.admin.client-logos.create');
    }

    public function store(ClientLogoRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['logo']);
        $data['is_active'] = $request->boolean('is_active');
        $data['logo_path'] = $this->uploader->store($request->file('logo'), 'client-logos');

        ClientLogo::create($data);

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Logotipo adicionado.');
    }

    public function edit(ClientLogo $clientLogo): View
    {
        return view('pages.admin.client-logos.edit', ['logo' => $clientLogo]);
    }

    public function update(ClientLogoRequest $request, ClientLogo $clientLogo): RedirectResponse
    {
        $data = $request->safe()->except(['logo']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->uploader->replace(
                $clientLogo->logo_path,
                $request->file('logo'),
                'client-logos',
            );
        }

        $clientLogo->update($data);

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Logotipo atualizado.');
    }

    public function destroy(ClientLogo $clientLogo): RedirectResponse
    {
        $this->uploader->delete($clientLogo->logo_path);
        $clientLogo->delete();

        return redirect()
            ->route('admin.client-logos.index')
            ->with('success', 'Logotipo removido.');
    }
}

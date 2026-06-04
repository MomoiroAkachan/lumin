<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get()
            ->groupBy('group');

        return view('pages.admin.site-settings.index', compact('settings'));
    }

    public function update(SiteSettingRequest $request): RedirectResponse
    {
        /** @var array<string, string|null> $payload */
        $payload = $request->validated('settings');

        foreach ($payload as $key => $value) {
            SiteSetting::query()
                ->where('key', $key)
                ->update(['value' => $value]);
        }

        SiteSetting::flushCache();

        return redirect()
            ->route('admin.site-settings.index')
            ->with('success', 'Configurações atualizadas.');
    }
}

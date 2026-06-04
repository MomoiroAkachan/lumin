<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $services = Service::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(15);

        return view('pages.admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('pages.admin.services.create');
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['icon_file']);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon_file')) {
            $data['icon_path'] = $this->uploader->store($request->file('icon_file'), 'services/icons');
        }

        Service::create($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Serviço criado com sucesso.');
    }

    public function edit(Service $service): View
    {
        return view('pages.admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->safe()->except(['icon_file']);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $service->id);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon_file')) {
            $data['icon_path'] = $this->uploader->replace(
                $service->icon_path,
                $request->file('icon_file'),
                'services/icons',
            );
        }

        $service->update($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->uploader->delete($service->icon_path);
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Serviço removido.');
    }

    private function resolveSlug(?string $providedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($providedSlug ?: $title);
        $slug = $base;
        $suffix = 2;

        while (Service::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}

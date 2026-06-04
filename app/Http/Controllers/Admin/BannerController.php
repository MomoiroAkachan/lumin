<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $banners = Banner::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(15);

        return view('pages.admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('pages.admin.banners.create');
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploader->store($request->file('image'), 'banners');
        }

        Banner::create($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner criado com sucesso.');
    }

    public function edit(Banner $banner): View
    {
        return view('pages.admin.banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploader->replace(
                $banner->image_path,
                $request->file('image'),
                'banners',
            );
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner atualizado com sucesso.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $this->uploader->delete($banner->image_path);
        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner removido.');
    }
}

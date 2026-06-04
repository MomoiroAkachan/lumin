<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryImageRequest;
use App\Models\GalleryImage;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $images = GalleryImage::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(24);

        return view('pages.admin.gallery.index', compact('images'));
    }

    public function create(): View
    {
        return view('pages.admin.gallery.create');
    }

    public function store(GalleryImageRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['is_active'] = $request->boolean('is_active');
        $data['image_path'] = $this->uploader->store($request->file('image'), 'gallery');

        GalleryImage::create($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Imagem adicionada à galeria.');
    }

    public function edit(GalleryImage $gallery): View
    {
        return view('pages.admin.gallery.edit', ['image' => $gallery]);
    }

    public function update(GalleryImageRequest $request, GalleryImage $gallery): RedirectResponse
    {
        $data = $request->safe()->except(['image']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploader->replace(
                $gallery->image_path,
                $request->file('image'),
                'gallery',
            );
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Imagem atualizada.');
    }

    public function destroy(GalleryImage $gallery): RedirectResponse
    {
        $this->uploader->delete($gallery->image_path);
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Imagem removida.');
    }
}

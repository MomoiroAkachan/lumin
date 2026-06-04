<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(15);

        return view('pages.admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('pages.admin.testimonials.create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['photo']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->uploader->store($request->file('photo'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Depoimento adicionado.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('pages.admin.testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->safe()->except(['photo']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->uploader->replace(
                $testimonial->photo_path,
                $request->file('photo'),
                'testimonials',
            );
        }

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Depoimento atualizado.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->uploader->delete($testimonial->photo_path);
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Depoimento removido.');
    }
}

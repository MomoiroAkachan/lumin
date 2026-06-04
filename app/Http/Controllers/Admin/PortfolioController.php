<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->withCount('images')
            ->orderBy('position')
            ->orderByDesc('id')
            ->paginate(15);

        return view('pages.admin.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        return view('pages.admin.portfolios.create');
    }

    public function store(PortfolioRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image', 'gallery']);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $this->uploader->store($request->file('cover_image'), 'portfolios/covers');
        }

        $portfolio = Portfolio::create($data);

        $this->storeGallery($portfolio, $request);

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('success', 'Portfólio criado.');
    }

    public function edit(Portfolio $portfolio): View
    {
        $portfolio->load('images');

        return view('pages.admin.portfolios.edit', compact('portfolio'));
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image', 'gallery']);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $portfolio->id);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $this->uploader->replace(
                $portfolio->cover_image_path,
                $request->file('cover_image'),
                'portfolios/covers',
            );
        }

        $portfolio->update($data);

        $this->storeGallery($portfolio, $request);

        return redirect()
            ->route('admin.portfolios.edit', $portfolio)
            ->with('success', 'Portfólio atualizado.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $this->uploader->delete($portfolio->cover_image_path);

        foreach ($portfolio->images as $image) {
            $this->uploader->delete($image->image_path);
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfólio removido.');
    }

    public function destroyImage(Portfolio $portfolio, PortfolioImage $image): RedirectResponse
    {
        abort_unless($image->portfolio_id === $portfolio->id, 404);

        $this->uploader->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Imagem da galeria removida.');
    }

    private function storeGallery(Portfolio $portfolio, Request $request): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        $position = $portfolio->images()->max('position') ?? 0;

        foreach ($request->file('gallery') as $file) {
            $portfolio->images()->create([
                'image_path' => $this->uploader->store($file, 'portfolios/'.$portfolio->id),
                'position' => ++$position,
            ]);
        }
    }

    private function resolveSlug(?string $providedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($providedSlug ?: $title);
        $slug = $base;
        $suffix = 2;

        while (Portfolio::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}

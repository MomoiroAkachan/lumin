<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyQualityRequest;
use App\Models\CompanyQuality;
use App\Support\PositionHelper;
use App\Services\MediaUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyQualityController extends Controller
{
    public function __construct(private readonly MediaUploadService $uploader) {}

    public function index(): View
    {
        $qualities = CompanyQuality::query()
            ->orderBy('position')
            ->orderByDesc('id')
            ->get();

        return view('pages.admin.company-qualities.index', compact('qualities'));
    }

    public function create(): View
    {
        return view('pages.admin.company-qualities.create');
    }

    public function store(CompanyQualityRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['icon_file']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon_file')) {
            $data['icon_path'] = $this->uploader->store($request->file('icon_file'), 'qualities');
        }

        $data['position'] = PositionHelper::next(CompanyQuality::class);

        CompanyQuality::create($data);

        return redirect()
            ->route('admin.company-qualities.index')
            ->with('success', 'Qualidade adicionada.');
    }

    public function edit(CompanyQuality $companyQuality): View
    {
        return view('pages.admin.company-qualities.edit', ['quality' => $companyQuality]);
    }

    public function update(CompanyQualityRequest $request, CompanyQuality $companyQuality): RedirectResponse
    {
        $data = $request->safe()->except(['icon_file']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon_file')) {
            $data['icon_path'] = $this->uploader->replace(
                $companyQuality->icon_path,
                $request->file('icon_file'),
                'qualities',
            );
        }

        $companyQuality->update($data);

        return redirect()
            ->route('admin.company-qualities.index')
            ->with('success', 'Qualidade atualizada.');
    }

    public function destroy(CompanyQuality $companyQuality): RedirectResponse
    {
        $this->uploader->delete($companyQuality->icon_path);
        $companyQuality->delete();

        return redirect()
            ->route('admin.company-qualities.index')
            ->with('success', 'Qualidade removida.');
    }
}

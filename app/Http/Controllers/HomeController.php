<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\ClientLogo;
use App\Models\CompanyQuality;
use App\Models\GalleryImage;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        return view('pages.landing.home', [
            'banners' => Banner::query()->where('is_active', true)->orderBy('position')->get(),
            'services' => Service::query()->where('is_active', true)->orderBy('position')->get(),
            'portfolios' => Portfolio::query()
                ->with('images')
                ->where('is_active', true)
                ->orderBy('position')
                ->get(),
            'qualities' => CompanyQuality::query()->where('is_active', true)->orderBy('position')->get(),
            'gallery' => GalleryImage::query()->where('is_active', true)->orderBy('position')->get(),
            'clientLogos' => ClientLogo::query()->where('is_active', true)->orderBy('position')->get(),
            'testimonials' => Testimonial::query()->where('is_active', true)->orderBy('position')->get(),
            'settings' => SiteSetting::dictionary(),
        ]);
    }
}

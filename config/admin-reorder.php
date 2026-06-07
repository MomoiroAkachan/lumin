<?php

use App\Models\Banner;
use App\Models\ClientLogo;
use App\Models\CompanyQuality;
use App\Models\GalleryImage;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;

return [
    'resources' => [
        'banners' => Banner::class,
        'services' => Service::class,
        'portfolios' => Portfolio::class,
        'company-qualities' => CompanyQuality::class,
        'gallery' => GalleryImage::class,
        'client-logos' => ClientLogo::class,
        'testimonials' => Testimonial::class,
    ],
];

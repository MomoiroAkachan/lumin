<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\ClientLogo;
use App\Models\CompanyQuality;
use App\Models\GalleryImage;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class AbsContentSeeder extends Seeder
{
    public function run(): void
    {
        Banner::factory(3)->create();

        Service::factory(6)->create();

        Portfolio::factory(4)
            ->hasImages(3)
            ->create();

        CompanyQuality::factory(4)->create();

        GalleryImage::factory(8)->create();

        ClientLogo::factory(8)->create();

        Testimonial::factory(5)->create();
    }
}

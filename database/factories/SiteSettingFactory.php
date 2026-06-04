<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->unique()->slug(2, false),
            'group' => fake()->randomElement(['general', 'footer', 'social', 'contact']),
            'label' => fake()->sentence(3),
            'type' => fake()->randomElement(['text', 'email', 'tel', 'url']),
            'value' => fake()->sentence(),
        ];
    }
}

<?php

namespace App\Models;

use Database\Factories\PortfolioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'slug', 'cover_image_path', 'description', 'link', 'position', 'is_active'])]
class Portfolio extends Model
{
    /** @use HasFactory<PortfolioFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    /**
     * @return HasMany<PortfolioImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('position');
    }
}

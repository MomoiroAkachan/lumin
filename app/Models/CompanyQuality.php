<?php

namespace App\Models;

use Database\Factories\CompanyQualityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'icon', 'icon_path', 'description', 'position', 'is_active'])]
class CompanyQuality extends Model
{
    /** @use HasFactory<CompanyQualityFactory> */
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
}

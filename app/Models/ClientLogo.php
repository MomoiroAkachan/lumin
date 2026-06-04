<?php

namespace App\Models;

use Database\Factories\ClientLogoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'logo_path', 'link', 'position', 'is_active'])]
class ClientLogo extends Model
{
    /** @use HasFactory<ClientLogoFactory> */
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

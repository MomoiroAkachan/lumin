<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('media_url')) {
    /**
     * Resolve a URL pública para um caminho de mídia.
     *
     * Aceita tanto um caminho relativo armazenado no disk configurado
     * (ex: "banners/abc.jpg") quanto uma URL absoluta (ex: vinda de seeders
     * de demonstração ou de campos onde o usuário colou um link externo).
     */
    function media_url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return Storage::url($path);
    }
}

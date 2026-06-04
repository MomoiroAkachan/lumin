<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Centraliza uploads de imagens do CMS para o disk configurado (S3 em produção,
 * local em dev). Mantém os controllers livres de lógica de armazenamento.
 */
class MediaUploadService
{
    public function __construct(
        private readonly ?string $disk = null,
    ) {}

    /**
     * Armazena um upload em `$directory` e retorna o caminho relativo salvo no disk.
     */
    public function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, $this->resolveDisk());
    }

    /**
     * Substitui um arquivo: apaga o antigo (se existir) e salva o novo.
     */
    public function replace(?string $oldPath, UploadedFile $file, string $directory): string
    {
        $this->delete($oldPath);

        return $this->store($file, $directory);
    }

    public function delete(?string $path): void
    {
        if ($path !== null && $path !== '' && Storage::disk($this->resolveDisk())->exists($path)) {
            Storage::disk($this->resolveDisk())->delete($path);
        }
    }

    /**
     * URL pública (S3 retorna URL assinada ou direta; local usa storage:link).
     */
    public function url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        return Storage::disk($this->resolveDisk())->url($path);
    }

    private function resolveDisk(): string
    {
        return $this->disk ?? (string) config('filesystems.default');
    }
}

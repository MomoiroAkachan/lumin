<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Default site settings exposed through the footer and contact sections.
     *
     * @var list<array{key: string, group: string, label: string, type: string, value: string|null}>
     */
    private const DEFAULTS = [
        ['key' => 'company_name', 'group' => 'general', 'label' => 'Nome da empresa', 'type' => 'text', 'value' => 'Abs Tecnosoluções'],
        ['key' => 'company_tagline', 'group' => 'general', 'label' => 'Slogan', 'type' => 'text', 'value' => 'Tecnologia que transforma'],
        ['key' => 'footer_about', 'group' => 'footer', 'label' => 'Texto institucional do rodapé', 'type' => 'textarea', 'value' => null],
        ['key' => 'contact_email', 'group' => 'contact', 'label' => 'E-mail de contato', 'type' => 'email', 'value' => null],
        ['key' => 'contact_phone', 'group' => 'contact', 'label' => 'Telefone', 'type' => 'tel', 'value' => null],
        ['key' => 'contact_whatsapp', 'group' => 'contact', 'label' => 'WhatsApp (somente números)', 'type' => 'tel', 'value' => null],
        ['key' => 'contact_address', 'group' => 'contact', 'label' => 'Endereço', 'type' => 'textarea', 'value' => null],
        ['key' => 'social_instagram', 'group' => 'social', 'label' => 'Instagram', 'type' => 'url', 'value' => null],
        ['key' => 'social_facebook', 'group' => 'social', 'label' => 'Facebook', 'type' => 'url', 'value' => null],
        ['key' => 'social_linkedin', 'group' => 'social', 'label' => 'LinkedIn', 'type' => 'url', 'value' => null],
        ['key' => 'social_youtube', 'group' => 'social', 'label' => 'YouTube', 'type' => 'url', 'value' => null],
    ];

    public function run(): void
    {
        foreach (self::DEFAULTS as $setting) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }

        SiteSetting::flushCache();
    }
}

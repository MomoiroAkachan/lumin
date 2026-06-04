<?php

use App\Models\Banner;
use App\Models\ClientLogo;
use App\Models\Service;
use App\Models\SiteSetting;

beforeEach(function () {
    SiteSetting::create(['key' => 'company_name', 'group' => 'general', 'label' => 'Empresa', 'type' => 'text', 'value' => 'Abs']);
    SiteSetting::create(['key' => 'company_tagline', 'group' => 'general', 'label' => 'Tagline', 'type' => 'text', 'value' => 'Tech']);
});

it('renderiza a landing page sem erro mesmo com conteúdo vazio', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Abs');
});

it('exibe banners ativos', function () {
    Banner::factory()->create(['title' => 'Banner Principal Ativo', 'is_active' => true]);
    Banner::factory()->inactive()->create(['title' => 'Banner Oculto']);

    $this->get(route('home'))
        ->assertSee('Banner Principal Ativo')
        ->assertDontSee('Banner Oculto');
});

it('lista serviços e logos de clientes', function () {
    Service::factory()->create(['title' => 'Hospedagem em nuvem']);
    ClientLogo::factory()->create(['name' => 'Cliente Estrela']);

    $this->get(route('home'))
        ->assertSee('Hospedagem em nuvem')
        ->assertSee('Cliente Estrela');
});

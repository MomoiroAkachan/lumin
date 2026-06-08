<?php

use App\Models\Service;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('reordena serviços via drag and drop', function () {
    $first = Service::factory()->create(['title' => 'Primeiro', 'position' => 0]);
    $second = Service::factory()->create(['title' => 'Segundo', 'position' => 1]);
    $third = Service::factory()->create(['title' => 'Terceiro', 'position' => 2]);

    $this->postJson(route('admin.reorder'), [
        'resource' => 'services',
        'order' => [$third->id, $first->id, $second->id],
    ])->assertOk()
        ->assertJson(['message' => 'Ordem atualizada.']);

    expect($third->fresh()->position)->toBe(0)
        ->and($first->fresh()->position)->toBe(1)
        ->and($second->fresh()->position)->toBe(2);
});

it('rejeita reordenação com ids inválidos', function () {
    $service = Service::factory()->create();

    $this->postJson(route('admin.reorder'), [
        'resource' => 'services',
        'order' => [$service->id, 99999],
    ])->assertUnprocessable();
});

it('exige autenticação para reordenar', function () {
    auth()->logout();

    $this->postJson(route('admin.reorder'), [
        'resource' => 'services',
        'order' => [1],
    ])->assertUnauthorized();
});

it('exibe seletor de ícones na criação de serviço', function () {
    $this->get(route('admin.services.create'))
        ->assertOk()
        ->assertSee('data-icon-picker', false)
        ->assertSee('Nuvem');
});

<?php

use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('local');
    $this->actingAs(User::factory()->create());
});

it('lista banners no admin', function () {
    Banner::factory()->create(['title' => 'Hero principal']);

    $this->get(route('admin.banners.index'))
        ->assertOk()
        ->assertSee('Hero principal');
});

it('cria um banner com upload de imagem', function () {
    $response = $this->post(route('admin.banners.store'), [
        'title' => 'Novo banner',
        'subtitle' => 'Subtítulo',
        'position' => 1,
        'is_active' => '1',
        'image' => UploadedFile::fake()->image('banner.jpg', 1200, 600),
    ]);

    $response->assertRedirect(route('admin.banners.index'));

    $banner = Banner::firstWhere('title', 'Novo banner');
    expect($banner)->not->toBeNull()
        ->and($banner->image_path)->not->toBeNull();

    Storage::disk('local')->assertExists($banner->image_path);
});

it('atualiza um banner e remove a imagem antiga ao trocá-la', function () {
    $oldFile = UploadedFile::fake()->image('old.jpg');
    $oldPath = $oldFile->store('banners', 'local');

    $banner = Banner::factory()->create(['image_path' => $oldPath]);

    $this->put(route('admin.banners.update', $banner), [
        'title' => 'Atualizado',
        'position' => 5,
        'is_active' => '1',
        'image' => UploadedFile::fake()->image('new.jpg'),
    ])->assertRedirect(route('admin.banners.index'));

    $banner->refresh();
    expect($banner->title)->toBe('Atualizado')
        ->and($banner->image_path)->not->toBe($oldPath);

    Storage::disk('local')->assertMissing($oldPath);
    Storage::disk('local')->assertExists($banner->image_path);
});

it('remove banner e imagem associada', function () {
    $file = UploadedFile::fake()->image('hero.jpg');
    $path = $file->store('banners', 'local');

    $banner = Banner::factory()->create(['image_path' => $path]);

    $this->delete(route('admin.banners.destroy', $banner))
        ->assertRedirect(route('admin.banners.index'));

    expect(Banner::find($banner->id))->toBeNull();
    Storage::disk('local')->assertMissing($path);
});

it('exige autenticação no admin', function () {
    auth()->logout();

    $this->get(route('admin.banners.index'))
        ->assertRedirect(route('login'));
});

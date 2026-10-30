<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

test('every blade view compiles so view:cache and optimize work', function () {
    expect(Artisan::call('view:cache'))->toBe(0);

    Artisan::call('view:clear');
});

test('the open graph image referenced by the home page exists', function () {
    $this->get('/')->assertOk()->assertSee(asset('img/og-govind.jpg'), false);

    expect(public_path('img/og-govind.jpg'))->toBeFile();
});

test('whatsapp redirects use the configured number', function () {
    config(['services.whatsapp.number' => '620000000000']);
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('submit-contact', ['name' => 'A', 'email' => 'a@example.com', 'message' => 'Hi']))
        ->assertRedirectContains('https://wa.me/620000000000?text=');
});

test('category validation errors are shown on the category page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Category::create(['name' => 'Design']);

    $this->actingAs($admin)
        ->from(route('admin.category'))
        ->followingRedirects()
        ->post(route('admin.category.store'), ['name' => 'Design'])
        ->assertOk()
        ->assertSee('The name has already been taken.');
});

test('users and admins are sent to their own home after password confirmation', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post('/confirm-password', ['password' => 'password'])
        ->assertRedirect(route('admin.home', absolute: false));
});

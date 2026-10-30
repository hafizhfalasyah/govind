<?php

use App\Models\Testimonial;
use App\Models\User;

test('users can submit a testimonial without an occupation', function () {
    $user = User::factory()->create(['img' => 'avatar.jpg']);

    $response = $this->actingAs($user)->post(route('submit-testimonial'), [
        'text' => 'Great program.',
    ]);

    $response->assertRedirect(route('home'))->assertSessionHas('success');
    expect(Testimonial::first())
        ->name->toBe($user->name)
        ->occupation->toBeNull()
        ->img->toBe('avatar.jpg')
        ->is_visible->toBeTrue();
});

test('testimonial text longer than the column is truncated for users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('submit-testimonial'), [
        'occupation' => 'Student',
        'text' => str_repeat('a', 400),
    ]);

    expect(mb_strlen(Testimonial::first()->text))->toBe(255);
});

test('home page shows testimonial photos from the users storage folder', function () {
    Testimonial::create(['name' => 'Budi', 'occupation' => null, 'text' => 'Nice', 'img' => 'budi.jpg', 'is_visible' => true]);

    $this->get('/')
        ->assertOk()
        ->assertSee(json_encode(asset('storage/users/budi.jpg')), false);
});

test('admin can open the testimonial edit page and update without occupation', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $testimonial = Testimonial::create(['name' => 'Budi', 'occupation' => 'Student', 'text' => 'Nice', 'is_visible' => true]);

    $this->actingAs($admin)->get(route('admin.testimonial.edit', $testimonial->id))
        ->assertOk()
        ->assertSee('Edit Testimonial')
        ->assertSee(route('admin.testimonial.update', $testimonial->id), false);

    $this->actingAs($admin)->put(route('admin.testimonial.update', $testimonial->id), [
        'name' => 'Budi S',
        'occupation' => '',
        'text' => 'Updated',
    ])->assertRedirect(route('admin.testimonial'));

    expect($testimonial->fresh())
        ->name->toBe('Budi S')
        ->occupation->toBeNull()
        ->is_visible->toBeFalse();
});

test('admin testimonial text is limited to 255 characters with a visible error', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $testimonial = Testimonial::create(['name' => 'Budi', 'occupation' => 'Student', 'text' => 'Nice', 'is_visible' => true]);

    $this->actingAs($admin)
        ->from(route('admin.testimonial'))
        ->followingRedirects()
        ->put(route('admin.testimonial.update', $testimonial->id), [
            'name' => 'Budi',
            'text' => str_repeat('a', 256),
        ])
        ->assertOk()
        ->assertSee('The text field must not be greater than 255 characters.');

    expect($testimonial->fresh()->text)->toBe('Nice');
});

<?php

use App\Models\Category;
use App\Models\Program;
use App\Models\User;

function makeProgram(array $attributes = []): Program
{
    $category = Category::create(['name' => 'Leadership '.uniqid()]);

    $program = new Program();
    $program->name = $attributes['name'] ?? 'Alpha Program';
    $program->slug = $attributes['slug'] ?? 'alpha-program-'.uniqid();
    $program->category_id = $category->id;
    $program->price = 1500000;
    $program->is_active = $attributes['is_active'] ?? true;
    $program->save();

    return $program;
}

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
});

test('admin can update an existing program without creating a new one', function () {
    $program = makeProgram();
    $category = Category::create(['name' => 'Technology']);

    $response = $this->actingAs($this->admin)->put(route('admin.program.update', $program->id), [
        'name' => 'Alpha Renamed',
        'slug' => 'alpha-renamed',
        'category_id' => $category->id,
        'price' => '2500000',
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('admin.program'))->assertSessionHas('success');
    expect(Program::count())->toBe(1);
    expect($program->fresh())
        ->name->toBe('Alpha Renamed')
        ->slug->toBe('alpha-renamed')
        ->category_id->toBe($category->id);
});

test('admin can deactivate a program by unticking the active checkbox', function () {
    $program = makeProgram(['is_active' => true]);

    $this->actingAs($this->admin)->put(route('admin.program.update', $program->id), [
        'name' => $program->name,
        'slug' => $program->slug,
        'category_id' => $program->category_id,
        'price' => '1500000',
    ]);

    expect($program->fresh()->is_active)->toBeFalse();
});

test('a program created with the active checkbox unticked is inactive', function () {
    $category = Category::create(['name' => 'Design']);

    $this->actingAs($this->admin)->post(route('admin.program.store'), [
        'name' => 'Draft Program',
        'category_id' => $category->id,
        'price' => '100',
    ]);

    expect(Program::where('name', 'Draft Program')->first())
        ->not->toBeNull()
        ->is_active->toBeFalse()
        ->slug->toBe('draft-program');
});

test('admin can delete a program', function () {
    $program = makeProgram();

    $response = $this->actingAs($this->admin)->delete(route('admin.program.delete', $program));

    $response->assertRedirect(route('admin.program'))->assertSessionHas('success');
    expect(Program::find($program->id))->toBeNull();
});

test('updating or deleting a missing program returns 404', function () {
    $this->actingAs($this->admin)->put(route('admin.program.update', 999), [])->assertNotFound();
    $this->actingAs($this->admin)->delete(route('admin.program.delete', 999))->assertNotFound();
    expect(Program::count())->toBe(0);
});

test('regular users cannot manage programs', function () {
    $program = makeProgram();
    $user = User::factory()->create();

    $this->actingAs($user)->delete(route('admin.program.delete', $program))->assertRedirect(route('home'));
    expect(Program::find($program->id))->not->toBeNull();
});

test('program validation errors are shown on the program page', function () {
    $this->actingAs($this->admin)
        ->from(route('admin.program'))
        ->followingRedirects()
        ->post(route('admin.program.store'), ['name' => '', 'price' => '-1'])
        ->assertOk()
        ->assertSee('The name field is required.');
});

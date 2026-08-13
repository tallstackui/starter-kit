<?php

declare(strict_types=1);

use App\Models\User;

it('renders the register page', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Register');
});

it('registers a new user', function () {
    $this->post(route('register.store'), [
        'name'                  => 'New User',
        'email'                 => 'new@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticated();

    expect(User::query()->where('email', 'new@example.com')->exists())->toBeTrue();
});

it('requires a unique email', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $this->post(route('register.store'), [
        'name'                  => 'New User',
        'email'                 => 'taken@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

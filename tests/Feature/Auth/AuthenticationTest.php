<?php

declare(strict_types=1);

use App\Models\User;

it('renders the login page', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Log in');
});

it('authenticates a user', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email'    => $user->email,
        'password' => 'Test123!',
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

it('does not authenticate with invalid credentials', function () {
    $user = User::factory()->create();

    $this->post(route('login.store'), [
        'email'    => $user->email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors();

    $this->assertGuest();
});

it('logs out an authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/');

    $this->assertGuest();
});

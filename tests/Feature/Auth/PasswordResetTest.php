<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

it('renders the forgot password page', function () {
    $this->get(route('password.request'))
        ->assertOk()
        ->assertSee('Forgot your password?');
});

it('sends a password reset link', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post(route('password.email'), [
        'email' => $user->email,
    ])->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class);
});

it('renders the reset password page', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post(route('password.email'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
        $this->get(route('password.reset', [
            'token' => $notification->token,
            'email' => $user->email,
        ]))->assertOk();

        return true;
    });
});

it('resets the password', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post(route('password.email'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
        $this->post(route('password.update'), [
            'token'                 => $notification->token,
            'email'                 => $user->email,
            'password'              => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertRedirect(route('login'));

        expect($user->refresh())->password->not->toBe('password');

        $this->post(route('login.store'), [
            'email'    => $user->email,
            'password' => 'new-password',
        ])->assertRedirect('/dashboard');

        return true;
    });
});

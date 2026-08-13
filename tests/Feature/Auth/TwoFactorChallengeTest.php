<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Fortify\Fortify;
use PragmaRX\Google2FA\Google2FA;

it('renders the two factor challenge after login', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->post(route('login.store'), [
        'email'    => $user->email,
        'password' => 'Test123!',
    ])->assertRedirect(route('two-factor.login'));

    $this->assertGuest();

    $this->get(route('two-factor.login'))->assertOk();
});

it('authenticates with a valid authentication code', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->post(route('login.store'), [
        'email'    => $user->email,
        'password' => 'Test123!',
    ]);

    $code = app(Google2FA::class)->getCurrentOtp(
        Fortify::currentEncrypter()->decrypt($user->two_factor_secret)
    );

    $this->post(route('two-factor.login.store'), [
        'code' => $code,
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

it('authenticates with a recovery code', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->post(route('login.store'), [
        'email'    => $user->email,
        'password' => 'Test123!',
    ]);

    $this->post(route('two-factor.login.store'), [
        'recovery_code' => $user->recoveryCodes()[0],
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

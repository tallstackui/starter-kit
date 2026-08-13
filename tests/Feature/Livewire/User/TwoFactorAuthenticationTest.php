<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use Laravel\Fortify\Fortify;
use PragmaRX\Google2FA\Google2FA;
use App\Livewire\User\Profile\TwoFactorAuthentication;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(TwoFactorAuthentication::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile.two-factor-authentication')
        ->assertSet('enabled', false)
        ->assertSet('pending', false);
});

it('requires the current password to enable', function () {
    Livewire::test(TwoFactorAuthentication::class)
        ->set('current_password', 'wrong-password')
        ->call('enable')
        ->assertHasErrors(['current_password']);
});

it('enables two factor authentication', function () {
    Livewire::test(TwoFactorAuthentication::class)
        ->set('current_password', 'password')
        ->call('enable')
        ->assertHasNoErrors()
        ->assertSet('pending', true)
        ->assertSet('enabled', false);

    expect($this->user->refresh()->two_factor_secret)->not->toBeNull()
        ->and($this->user->two_factor_confirmed_at)->toBeNull();
});

it('confirms two factor authentication', function () {
    Livewire::test(TwoFactorAuthentication::class)
        ->set('current_password', 'password')
        ->call('enable');

    $user = $this->user->refresh();
    $code = app(Google2FA::class)->getCurrentOtp(
        Fortify::currentEncrypter()->decrypt($user->two_factor_secret)
    );

    Livewire::test(TwoFactorAuthentication::class)
        ->set('code', $code)
        ->call('confirm')
        ->assertHasNoErrors()
        ->assertSet('enabled', true);

    expect($this->user->refresh()->two_factor_confirmed_at)->not->toBeNull();
});

it('rejects an invalid confirmation code', function () {
    Livewire::test(TwoFactorAuthentication::class)
        ->set('current_password', 'password')
        ->call('enable');

    Livewire::test(TwoFactorAuthentication::class)
        ->set('code', '000000')
        ->call('confirm')
        ->assertHasErrors(['code']);
});

it('disables two factor authentication', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->actingAs($user);

    Livewire::test(TwoFactorAuthentication::class)
        ->set('current_password', 'password')
        ->call('disable')
        ->assertHasNoErrors()
        ->assertSet('enabled', false);

    expect($user->refresh()->two_factor_secret)->toBeNull();
});

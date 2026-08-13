<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use App\Livewire\User\Profile\Password;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(Password::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile.password');
});

it('requires the current password', function () {
    Livewire::test(Password::class)
        ->set('current_password', '')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertHasErrors(['current_password' => 'required']);
});

it('rejects an invalid current password', function () {
    Livewire::test(Password::class)
        ->set('current_password', 'wrong-password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertHasErrors(['current_password']);
});

it('validates password confirmation', function () {
    Livewire::test(Password::class)
        ->set('current_password', 'Test123!')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'wrong-confirmation')
        ->call('save')
        ->assertHasErrors(['password' => 'confirmed']);
});

it('updates the password', function () {
    Livewire::test(Password::class)
        ->set('current_password', 'Test123!')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('current_password', null)
        ->assertSet('password', null)
        ->assertSet('password_confirmation', null);

    expect(Hash::check('new-password', $this->user->refresh()->password))->toBeTrue();
});

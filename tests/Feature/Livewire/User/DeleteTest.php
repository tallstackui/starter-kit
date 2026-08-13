<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Profile\Delete;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(Delete::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile.delete');
});

it('requires the current password', function () {
    Livewire::test(Delete::class)
        ->set('password', '')
        ->call('delete')
        ->assertHasErrors(['password' => 'required']);
});

it('rejects an invalid password', function () {
    Livewire::test(Delete::class)
        ->set('password', 'wrong-password')
        ->call('delete')
        ->assertHasErrors(['password']);
});

it('deletes the profile and logs the user out', function () {
    Livewire::test(Delete::class)
        ->set('password', 'password')
        ->call('delete')
        ->assertHasNoErrors()
        ->assertRedirect(route('welcome'));

    $this->assertGuest();

    expect(User::query()->whereKey($this->user->id)->exists())->toBeFalse();
});

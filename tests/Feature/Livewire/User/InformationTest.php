<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Profile\Information;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(Information::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile.information');
});

it('mounts with authenticated user data', function () {
    Livewire::test(Information::class)
        ->assertSet('user.id', $this->user->id)
        ->assertSet('user.name', $this->user->name);
});

it('validates required name', function () {
    Livewire::test(Information::class)
        ->set('user.name', '')
        ->call('save')
        ->assertHasErrors(['user.name' => 'required']);
});

it('validates maximum length of name', function () {
    Livewire::test(Information::class)
        ->set('user.name', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['user.name' => 'max']);
});

it('updates the name without changing the email', function () {
    $email = $this->user->email;

    Livewire::test(Information::class)
        ->set('user.name', 'Updated Name')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('updated');

    expect($this->user->refresh())
        ->name->toBe('Updated Name')
        ->email->toBe($email);
});

it('dispatches success alert after saving', function () {
    Livewire::test(Information::class)
        ->set('user.name', 'Updated Again')
        ->call('save')
        ->assertDispatched('updated')
        ->assertDispatched('ts-ui:dialog', function (string $event, array $params) {
            return $event === 'ts-ui:dialog' &&
                $params['type'] === 'success' &&
                $params['title'] === 'Done!';
        });
});

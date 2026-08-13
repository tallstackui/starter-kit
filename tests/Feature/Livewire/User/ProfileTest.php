<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Profile;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('renders the profile page with tabs', function () {
    Livewire::test(Profile::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile')
        ->assertSee(__('Profile'))
        ->assertSee(__('Password'))
        ->assertSee(__('Two Factor Authentication'));
});

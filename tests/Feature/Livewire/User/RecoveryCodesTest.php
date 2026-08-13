<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\User\Profile\RecoveryCodes;

beforeEach(function () {
    $this->user = User::factory()->withTwoFactor()->create();

    $this->actingAs($this->user);
});

it('renders successfully', function () {
    Livewire::test(RecoveryCodes::class)
        ->assertOk()
        ->assertViewIs('livewire.user.profile.recovery-codes');
});

it('downloads the recovery codes', function () {
    Livewire::test(RecoveryCodes::class)
        ->call('download')
        ->assertFileDownloaded('recovery_codes-'.config('app.name').'_'.$this->user->email.'.txt');
});

it('regenerates recovery codes', function () {
    $original = $this->user->recoveryCodes();

    Livewire::test(RecoveryCodes::class)
        ->call('regenerate')
        ->assertHasNoErrors();

    expect($this->user->refresh()->recoveryCodes())->not->toBe($original);
});

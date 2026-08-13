<?php

declare(strict_types=1);

use App\Models\User;

if (! function_exists('user')) {
    /**
     * Retrieve the authenticated user via `auth()->user()`.
     */
    function user(): ?User
    {
        return auth()->user();
    }
}

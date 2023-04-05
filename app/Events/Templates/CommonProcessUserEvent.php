<?php

declare(strict_types = 1);

namespace App\Events\Templates;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class CommonProcessUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private User $user
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

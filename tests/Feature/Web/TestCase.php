<?php

namespace Tests\Feature\Web;

use App\Models\Admin;

class TestCase extends \Tests\TestCase
{
    protected Admin $user;
    protected Admin $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = Admin::factory()->create();
        $this->admin = Admin::first();
    }
}

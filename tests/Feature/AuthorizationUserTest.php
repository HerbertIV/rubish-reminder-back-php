<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthorizationUserTest extends TestCase
{
    private static $successUserData = [
        'email' => 'user@example.com',
        'password' => 'Testtest!23'
    ];
    private static $failUserData = [
        'email' => 'user',
        'password' => 'test'
    ];

    public function test_success_register_user(): void
    {
        $response = $this->post('auth/register', self::$successUserData);
        $response
            ->assertSessionHasNoErrors()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->where('email', fn (string $email) => $email === self::$successUserData['email'])
                    ->has('token')
            )
            ->assertOk();
    }

    public function test_fail_register_user(): void
    {
        $response = $this->post('auth/register', self::$failUserData);
        $response
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function test_fail_login_user(): void
    {
        $this->test_success_register_user();
        $response = $this->post('auth/login', self::$failUserData);
        $response
            ->assertSessionHasErrors(['email']);
    }

    public function test_success_login_user(): void
    {
        $this->test_success_register_user();
        $response = $this->post('auth/login', self::$successUserData);
        $response
            ->assertSessionHasNoErrors()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->where('email', fn (string $email) => $email === self::$successUserData['email'])
                    ->has('token')
            )
            ->assertOk();
    }
}

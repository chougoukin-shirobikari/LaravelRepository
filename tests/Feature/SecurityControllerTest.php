<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SecurityControllerTest extends TestCase
{
    use RefreshDataBase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');

    }

    public function testLogin(): void
    {
        $user = [
            'username' => 'admin',
            'password' => 'password'
        ];

        $response = $this->post(url('Authentication'), $user);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect(url('TopPage'));
        $response->assertSessionHas('username', 'admin');
        $response->assertSessionHas('role', 'ADMIN');
    }

    public function testLogout(): void
    {
        $user = [
            'username' => 'admin',
            'password' => 'password'
        ];

        $response = $this->post(url('Authentication'), $user);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertSessionHas('username', 'admin');
        $response->assertSessionHas('role', 'ADMIN');

        $response = $this->withSession(['username' => 'admin'])->post(url('logout'));
        $response->assertStatus(302);
        $response->assertRedirect(url('login'));
        $response->assertSessionMissing('username');
        $response->assertSessionMissing('role');

    }
}

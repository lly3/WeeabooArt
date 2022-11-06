<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthApiTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');

        // for testing, we need to create a user
        $this->post('/api/auth/register', [
            'name' => 'Ramita Wisutwattanasak',
            'email' => 'ramita.wi@ku.th',
            'date_of_birth' => '2001-10-17',
            'image_id' => 1, // image_id is required
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
    }

    public function test_register_success()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'test',
            'email' => 'user@example.com',
            'date_of_birth' => '1990-01-01',
            'image_id' => 1, // image_id is required
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201); // 201 is created
    }

    public function test_register_with_password_not_match()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'test',
            'email' => 'user@example.com',
            'date_of_birth' => '1990-01-01',
            'image_id' => 1, // image_id is required
            'password' => 'password',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(422); // 422 is unprocessable entity
    }

    public function test_login_success()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'ramita.wi@ku.th',
            'password' => '12345678',
        ]);

        $response->assertStatus(200); // 200 is success
    }

    public function test_login_with_wrong_password()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'ramita.wi@ku.th',
            'password' => '123456789',
        ]);

        $response->assertStatus(401); // 401 is unauthorized
    }
}

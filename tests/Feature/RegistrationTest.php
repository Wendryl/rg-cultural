<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_load_registration_form()
    {
        $response = $this->get('/registrar');

        $response->assertStatus(200);
    }

    public function test_should_return_error_when_user_name_is_empty()
    {
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $this->followRedirects($response)->assertSee('O campo nome é obrigatório');

    }

    public function test_should_return_error_when_user_email_is_empty()
    {
        $response = $this->post('/register', [
            'name' => 'admin',
            'password' => 'password'
        ]);

        $this->followRedirects($response)->assertSee('O campo e-mail é obrigatório');

    }

    public function test_should_return_error_when_user_password_is_empty()
    {
        $response = $this->post('/register', [
            'name' => 'admin',
            'password' => 'password'
        ]);

        $this->followRedirects($response)->assertSee('O campo e-mail é obrigatório');

    }
}

<?php

namespace Tests\Feature;

use App\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Providers\RouteServiceProvider;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered()  // kiểm tra màn hình đăng ký có hiển thị hay không
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
    public function test_new_users_can_register(){
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testLogin(){
        $plainPassword = '123123123';
        $user = User::create(
            [
                'name'=>'vanTien',
                'username'=>'tien',
                'email'=>'tien@gmail.com',
                'password'=>Hash::make($plainPassword),
            ]
        );
        $response = $this->post('/login', ['email'=>$user->email, 'password' => $plainPassword]);
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }
    public function testLoginInCorrectPassword(){
        $plainPassword = '12312312';
        $user = User::create(
            [
                'name'=>'nhattruong',
                'username'=>'truong',
                'email'=>'truong@gmail.com',
                'password'=>Hash::make($plainPassword),
            ]
        );
        $response = $this->post('/login', ['email'=>$user->email, 'password' => $plainPassword]);
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }
}

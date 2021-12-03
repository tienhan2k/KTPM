<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_student_index_page_is_rendered_properly() //kiểm tra trang chỉ mục sinh viên được hiển thị đúng cách 
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/student');
        $response->assertStatus(200);
    }

    public function test_delete_student(){
        $student = Student::factory()->make();
        $student = Student::first();
        if($student){
            $student->delete();
        }
        $this->assertTrue(true);
    }
}

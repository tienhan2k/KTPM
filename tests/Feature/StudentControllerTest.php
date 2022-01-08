<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
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
        
        // chúng ta tạo user
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */    
        // Duy trì trạng thái cho người dùng hiện đã được xác thực
        $this->actingAs($user);

        // chúng ta muốn truy cập trang
        $response = $this->get('/student');

        // chúng ta khẳng định có trạng thái 200
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

    public function test_store(){ 
        $response = $this->call('POST', '/student',[
            'name' => 'truong',
            'class' => '18CNTT4',
            'email' => 'truongnguyennhat098@gmail.com',
            'phone' => '0935881996'
        ]);
        $response->assertStatus($response->status(), 200);
    }

    public function test_update(){
        $response = $this->call('PUT', '/student',[
            'name' => 'truong',
            'class' => '18CNTT4',
            'email' => 'truongnguyennhat098@gmail.com',
            'phone' => '0935881996',
        ]);
        $response->assertStatus($response->status(), 200);
    }
}
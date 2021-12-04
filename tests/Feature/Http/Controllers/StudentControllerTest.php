<?php

namespace Tests\Feature\Http\Controllers;

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

    public function test_users_can_create_students() //người dùng thử nghiệm có thể tạo sinh viên 
    { 
        // $this->withoutExceptionHandling(); 

        // chúng ta tạo user
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        // Duy trì trạng thái cho người dùng hiện đã được xác thực
        $this->actingAs($user); 

        //Truy cập vào url sinh viên bằng phương thức Post 
        $response = $this->post('/student',[
            'name' => 'Truong',
            'class'=> '18CNTT4',
        ]);

        // Chúng ta đã được chuyển hướng đến trang sinh viên
        $response->assertStatus(200);
        
        //
        $student = Student::first(); 

        $this->assertEquals(1, Student::count());

        // Chúng ta yêu cầu student có dự liệu thích hợp
        $this->assertEquals('truong', $student->name);
        $this->assertEquals('18CNTT4', $student->class);
        $this->assertEquals('truongnguyennhat098@gmail.com', $student->email);
        $this->assertEquals('0935881966', $student->phone);
        $this->assertEquals($user->id, $student->user->id);
        $this->assertInstanceOf(User::class, $student->user);

    }
}
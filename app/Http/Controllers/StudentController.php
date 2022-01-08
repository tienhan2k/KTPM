<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Student::class, 'student');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $students = Student::where(function($query) use ($keyword){
            $query->where('name', 'like', "%{$keyword}%");
        })->paginate(3);

        // $student = Student::all();
        return view('index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
            $request->validate([
                'name' => 'alpha|required|max:30',
                'class' => 'required|max:50',
                'email' => 'required|string|email|max:100|nullable|ends_with:@gmail.com',
                'phone' => 'required|numeric|between:10,12',                
            ]);
            Student::create($request->all());
            return redirect()->route('student.index')
            ->with('success','Sinh viên đã lưu thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        // Student::findOrFail($student);
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $updateData = $request->validate([
            'name' => 'alpha|required|max:30',
            'class' => 'required|max:50',
            'email' => 'required|string|email|max:100|nullable|ends_with:@gmail.com',
            'phone' => 'required|between:10,12',
        ]);
        $student->update($updateData);
        return redirect('/student')->with('success', 'Sinh viên cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('/student')->with('success', 'Sinh viên đã xóa thành công !');
    }
}

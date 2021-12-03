@extends('layouts.app')
 
  @section('content')

<div class="container" >
      <div class="row">
          <div class="col-lg-8">
                <form action="">
                  <div class="row">
                      <div class="col-md-4">
                        <input  placeholder="Tìm kiếm tên sinh viên" 
                                type="text" name="keyword"
                                class="form-control" 
                                value="{{ request()->input('keyword') }}">
                      </div>
                      <div class="col-md-4">
                          <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                      </div>
                  </div>
                </form>
          </div>

          <div class="col-lg-4">
            <div class="d-flex flex-row-reverse bd-highlight">
               <div class="p-2 bd-highlight">
                   @can('create','App\Models\Student')
                   <div class="pull-right">
                      <a class="btn btn-primary " href="{{ route('student.create') }}"> Create new Student</a>
                   </div>
                   @endcan
                </div>
            </div>
          </div>
  </div>

  <div>
  @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <p>{{ $message }}</p>
          </div>
  @endif
    <table class="table">
      <thead>
          <tr class="table-warning">
            <td>ID</td>
            <td>Name</td>
            <td>Class</td>
            <td>Email</td>
            <td>Phone</td>
            <td class="text-center">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($students as $student)
          <tr>
              <td>{{$student->id}}</td>
              <td>{{$student->name}}</td>
              <td>{{$student->class}}</td>
              <td>{{$student->email}}</td>
              <td>{{$student->phone}}</td>
              <td class="text-center">
                   @can('update',$student)
                        <a href="{{ route('student.edit', ['student'=>$student]) }}" class="btn btn-primary btn-sm">Edit</a>
                   @endcan

                  <!-- <form action="{{ route('student.destroy', ['student'=>$student])}}" method="post" style="display: inline-block">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form> -->
                  
                  @can('delete', $student)
                    @include('common.delete', [
                      'route'=>'student.destroy',
                      'item_name'=>'student',
                      'item'=>$student,
                      ])
                  @endcan
              </td>
          </tr>
            @endforeach
      </tbody>
    </table>
      <div class="d-flex justify-content-center">
       {{ $students->appends(request()->all())}}
      </div>
  </div>  
</div>  
  @endsection
    
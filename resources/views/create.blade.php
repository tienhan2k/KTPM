
@extends('studentlayout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="card-header">
            <h2>Add User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('student.index') }}"> Back</a>
        </div>
    </div>
</div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('student.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="class">Class</label>
              <input type="class" class="form-control" name="class"/>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" name="phone"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Create User</button>
      </form>
  </div>
</div>
</div>

@endsection
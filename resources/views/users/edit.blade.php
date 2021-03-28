@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$user->name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="/users">Users</a></li>
              <li class="breadcrumb-item active">{{$user->name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Edit {{$user->name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="/users/{{$user->id}}">
              @method('PUT') 
              @csrf

                <div class="card-body">

                <div class="text-center">
                    @if($user->picture)
                    <img class="profile-user-img img-fluid img-circle"
                       src="/storage/profile_images/{{$user->picture}}"
                       alt="User profile picture">
                    @else
                    <img class="profile-user-img img-fluid img-circle"
                       src="/storage/profile_images/noimage.jpg"
                       alt="User profile picture">

                    @endif
                </div>
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                  </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email"  class="form-control" value="{{$user->email}}">
                  </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" name="phone"  class="form-control" value="{{$user->phone}}">
                  </div>

                  <h4>Role</h4>

                @foreach($user->roles as $role)
                    <span class="round">{{$role->name}} <a class="del" onclick="return confirm('Are you sure you want to revoke {{$role->name}} role to {{$user->name}}?')" href="/user/{{$user->id}}/role/{{$role->id}}"><i class="fas fa-times-circle"></i></a></span>
                @endforeach
                <hr>
                <h4>Add Roles</h4>

                @foreach($roles as $role)
                  @if($role->name != "")
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$role->name}}" class="form-check-input" id="{{$role->name}}">
                        <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
                    </div>
                  @endif
                @endforeach
                <!-- /.card-body -->

                <div class="card-footer mt-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
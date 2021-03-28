@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Users</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">users</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Users</h3>
                  <div class="card-tools">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">New User</button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                @if(count($users) > 0)
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Gender</th>
                      <th>Date</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                    <td>

                      @if($user->picture)
                      <img style="width:40px" class="profile-user-img img-fluid img-circle"
                        src="/storage/profile_images/{{$user->picture}}"
                        alt="User profile picture">
                      @else
                      <img style="width:40px" class="profile-user-img img-fluid img-circle"
                        src="/storage/profile_images/noimage.jpg"
                        alt="User profile picture">

                      @endif

                    </td>
                      <td><a href="/users/{{$user->id}}/edit">{{$user->name}}</a></td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->gender}}</td>
                      <!-- <td>{{date('d-M-Y H:i A', strtotime($user->created_at))}}</td> -->
                      <td>{{$user->created_at->diffForHumans()}}</td>
                      <td>
                        @foreach($user->roles as $role)
                          <h3 class="badge badge-pill badge-primary">{{$role->name}}</h3>
                        @endforeach
                      </td>
                      <td align="center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button>
                          <a href="/users/{{$user->id}}/edit" class="btn btn-default btn-sm"><i class="fas fa-pen"></i></a>
                          <a onclick="return confirm('Are you sure you want to delete {{$user->name}}?')" href="/users/{{$user->id}}" class="btn btn-default btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                    <p>No data found !</p>
                @endif
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="/users">
            @csrf
            
            <div class="modal-body">

                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="text" class="form-control" name="phone" placeholder="Phone number">
                    </div>
                    <br>
                    <div class="form-group">
                        <select class="form-control" name="gender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Default password">
                    </div>
                    <br>
                    <h4>Attach Role</h4>

                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{$role->name}}" class="form-check-input" id="{{$role->name}}">
                            <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
                        </div>
                    @endforeach
                    <!-- /.card-body -->
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection
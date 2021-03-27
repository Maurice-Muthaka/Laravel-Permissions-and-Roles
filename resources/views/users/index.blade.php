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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                @if(count($users) > 0)
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td><a href="/users/{{$user->id}}">{{$user->name}}</a></td>
                      <td>{{date('d-M-Y H:i A', strtotime($user->created_at))}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        @foreach($user->roles as $role)
                          <h3 class="badge badge-pill badge-primary">{{$role->name}}</h3>
                        @endforeach
                      </td>
                      <td align="center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-pen"></i></button>
                          <button type="button" class="btn btn-default btn-sm"><i class="fas fa-trash"></i></button>
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

@endsection
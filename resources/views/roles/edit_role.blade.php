@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$role->name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="/roles">Roles</a></li>
              <li class="breadcrumb-item active">{{$role->name}}</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit {{$role->name}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="/role_store/{{$role->id}}">
              @csrf

                <div class="card-body">
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Role name</label>
                    <input type="email" class="form-control" value="{{$role->name}}" readonly>
                  </div>
                <div class="form-group">
                    <label for="">Add Permissions</label>
                </div>

                @foreach($permissions as $permission)

                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="form-check-input" id="{{$permission->name}}">
                        <label class="form-check-label" for="{{$permission->name}}">{{$permission->name}}</label>
                    </div>
                @endforeach
                <!-- /.card-body -->

                <div class="card-footer">
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
@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Permissions</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">permissions</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <!-- /.card -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Permissions</h3>

                <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-permission">Add Permission</button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
                </div>
                <div class="card-body">
                @if(count($permissions) > 0)
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td>
                                  @foreach($permission->roles as $role)
                                      <span class="badge badge-pill badge-success pl-3 pr-3">{{$role->name}}</span>
                                  @endforeach
                                </td>
                                <td class="py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table> 
                    </div>
                @else
                    <p>No Permission found</p>
                @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="modal-permission">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Permission</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="/permissions">
            @csrf
            
            <div class="modal-body">

                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Permission Name">
                    </div>
                
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
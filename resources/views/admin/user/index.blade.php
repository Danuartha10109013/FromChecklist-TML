@extends('layout.main')
@section('title')
    Kelola User
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account"></i>
          </span> User
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-end ">
                <span style="padding: 10px;border-radius: 5px" class=" page-title-icon bg-gradient-primary text-white me-2">
                  <a style="color: white;text-decoration: none" href="{{route('admin.user-add')}}" class="mdi mdi-account">Add User</a>
                </span> 
                <p style="margin-top: -25px" class="text-start">All Users</p></h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>
                          <th>Role</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $d)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $d->name }}</td>
                          <td>{{ $d->username }}</td>
                          <td>{{ $d->email }}</td>
                          <td>
                            @if ($d->active == 1)
                            <a href="{{route('admin.user-inactive', $d->id)}}">
                              <label class="badge badge-gradient-success">Active</label>
                            </a>
                              @else
                              <a href="{{route('admin.user-active', $d->id)}}">
                                <label class="badge badge-gradient-danger">Off</label>
                              </a>
                            @endif
                          </td>
                          
                          <td>
                            <a href="{{route('admin.user-edit',$d->id)}}">
                              <i class="mdi mdi-pencil text-success"></i>
                            </a>
                            <a href="{{route('admin.user-delete',$d->id)}}">
                              <i class="mdi mdi-delete text-danger"></i>
                            </a>
                          </td>
                          <td>
                            @if ($d->role == 1)
                                Admin
                            @else
                                Pegawai
                            @endif
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    


@endsection

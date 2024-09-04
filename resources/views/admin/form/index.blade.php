@extends('layout.main')
@section('title')
    Kelola Form
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-form-select"></i>
          </span> Kelola Forms
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
                  <a style="color: white;text-decoration: none" href="{{route('admin.form-add')}}" class="mdi mdi-forms-select">Add Forms</a>
                </span> 
                <p style="margin-top: -25px" class="text-start">All Forms</p></h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Forms</th>
                          <th>Status</th>
                          <th>Kategori</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($data as $d)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $d->nama }}</td>
                          <td>
                            @if ($d->active == 1)
                            <a href="{{route('admin.form-inactive', $d->id)}}">
                              <label class="badge badge-gradient-success">Active</label>
                            </a>
                              @else
                              <a href="{{route('admin.form-active', $d->id)}}">
                                <label class="badge badge-gradient-danger">Off</label>
                              </a>
                            @endif
                          </td>
                          <td>{{ $kategori[$d->id] ?? 'Kategori Tidak Ditemukan' }}</td>
                          <td>
                            <a href="{{route('admin.form-edit',$d->id)}}">
                              <i class="mdi mdi-pencil text-success"></i>
                            </a>
                            <a href="{{route('admin.form-delete',$d->id)}}">
                              <i class="mdi mdi-delete text-danger"></i>
                            </a>
                            <a href="{{route('admin.form-show',$d->id)}}">
                              <i class="mdi mdi-eye text-primary"></i>
                            </a>
                          </td>
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

@extends('layout.main')
@section('title')
@foreach ($data as $d)
    Form {{$d->nama}}
    
@endforeach
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-form-select"></i>
            @foreach ($data as $d)
            @php
            
        
            // Mengambil nama kategori berdasarkan ID
            $kate = \App\Models\KateFormsModel::where('id', $d->kategori)->value('kategori');
        @endphp
        
            </span> Form {{$kate}} {{$d->nama}}
            @endforeach
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
  @foreach ($form as $f)
    
 
  @if ($f->label == null)
    <a class="btn btn-success" style="border-radius: 5px" href="{{route('admin.form-add-list',$f->id_forms)}}">Tambahkan Form</a>
  @else
  <div class="row">
    
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <img src="{{asset('vendor/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Total Response <i class="mdi mdi-diamond mdi-24px float-end"></i>
          </h4>
          <h2 class="mb-5">95,5741</h2>
          @foreach ($data as $d)
            @php
            
        
            // Mengambil nama kategori berdasarkan ID
            $kate = \App\Models\KateFormsModel::where('id', $d->kategori)->value('kategori');
        @endphp
          <h6 class="card-text">{{$kate}} {{$d->nama}}</h6>
          @endforeach
        </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-end ">
              <p style="margin-top: -25px" class="text-start">Isi Form</p>
            </h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Label</th>
                        <th>Type</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($formFields as $index => $formField)
                        @php
                            // Split comma-separated values into arrays
                            $labels = explode(',', $formField->label);
                            $types = explode(',', $formField->type);
                        @endphp
                        @foreach($labels as $i => $label)
                            <tr>
                                <td>{{ $index * count($labels) + $i + 1 }}</td>
                                <td>{{ $label }}</td>
                                <td>{{ $types[$i] ?? 'N/A' }}</td>
                                
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>

            </table>
            <a href="{{ route('admin.form-add-edit', $formField->id) }}" class="btn btn-warning btn-sm mt-3">Edit</a>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
  @endforeach

      
      
    </div>
    


@endsection

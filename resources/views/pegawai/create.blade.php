@extends('layout.main')

@section('title')
    Form || {{$title}}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-file-document"></i>
                </span> Fill the Form
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span> Form Input <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Fields</h4>
                        <form action="{{ route('pegawai.form.store', ['id' => $id, 'id_field' => $id_field]) }}" method="POST">
                            @csrf

                            @foreach ($data as $d)
                                @php
                                    $labels = explode('|', $d->label);
                                    $types = explode('|', $d->type);
                                @endphp

                                @foreach ($labels as $index => $label)
                                    <div class="form-group">
                                        <label for="{{ $label }}">{{ $label }}</label>
                                        <input type="{{ $types[$index] }}" class="form-control" name="{{ $label }}" id="{{ $label }}">
                                    </div>
                                @endforeach
                            @endforeach
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

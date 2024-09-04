@extends('layout.main')
@section('title')
    Dashboard @if(Auth::user()->role == 1)
        Admin
    @elseif(Auth::user()->role == 2)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Tambahkan Form
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        @if (session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <form action="{{route('admin.form-add-save',$data)}}" method="post" class="forms-sample">
        <div class="row">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Input Form</h4>
                            @csrf
                            @method('PUT')

                            <input type="text" class="form-control" id="id" name="id" value="{{$data}}" hidden>

                            <div id="input-container">
                                <div class="input-group" id="input-group-1">

                                    <div class="form-group">
                                        <label for="data1">Label 1:</label>
                                        <input type="text" class="form-control" id="data1" name="data[]" placeholder="Masukkan Data" required>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Input Form</h4>
                            @csrf
                            <div id="input-container1">
                                <div class="input-group1" id="input-group1-1">
                                    <div class="form-group">
                                        <label for="type1">Select Type 1:</label>
                                        <select class="form-control" id="type1" name="type[]">
                                            <option value="text">Text</option>
                                            <option value="number">Number</option>
                                            <option value="email">Email</option>
                                            <option value="date">Date</option>
                                            <option value="TIME">Time</option>
                                            <option value="file">File</option>
                                        </select>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-2">
                    <button style="border-radius: 5px" type="button" class="btn btn-gradient-primary me-2" onclick="addInputField()">Tambah</button>
                </div>
                <div class="col-lg-2">
                    <button style="border-radius: 5px" type="button" class="btn btn-gradient-danger me-2" onclick="removeInputField()">Hapus</button>
                </div>
                <div class="col-lg-2">
                    <button style="border-radius: 5px" type="submit" class="btn btn-gradient-success">Submit</button>
                </div>
                <div class="col-lg-3"></div>
            </form>
        </div>
    </div>
    </div>
</div>

<script>
    var inputCount = 1;

    function addInputField() {
        inputCount++;
        var container = document.getElementById("input-container");
        var container1 = document.getElementById("input-container1");

        var inputGroup = `
            <div class="input-group" id="input-group-${inputCount}">
                <div class="form-group">
                    <label for="data${inputCount}">Label ${inputCount}:</label>
                    <input type="text" class="form-control" id="data${inputCount}" name="data[]" placeholder="Masukkan Data" required>
                </div>
            </div>`;

        var inputGroup1 = `
            <div class="input-group1" id="input-group1-${inputCount}">
                <div class="form-group">
                    <label for="type${inputCount}">Select Type ${inputCount}:</label>
                    <select class="form-control" id="type${inputCount}" name="type[]">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="date">Date</option>
                        <option value="TIME">Time</option>
                        <option value="file">File</option>
                    </select>
                </div>
            </div>`;

        container.insertAdjacentHTML('beforeend', inputGroup);
        container1.insertAdjacentHTML('beforeend', inputGroup1);
    }

    function removeInputField() {
        if (inputCount > 1) {
            var group = document.getElementById(`input-group-${inputCount}`);
            var group1 = document.getElementById(`input-group1-${inputCount}`);
            if (group) group.remove();
            if (group1) group1.remove();
            inputCount--;
        }
    }
</script>
@endsection

@extends('layout.main')
@section('title')
    Edit Form
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-form-select"></i>
          </span> Edit Form
        </h3>
      </div>

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif

      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('admin.form-update', $form->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label for="nama">Nama Form</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $form->nama) }}" required>
                </div>

                <div class="form-group">
                  <label for="kategori">Kategori</label>
                  <select class="form-control" id="kategori" name="kategori" required>
                    @foreach($kategori as $k)
                      <option value="{{ $k->id }}" {{ $k->id == $form->kategori ? 'selected' : '' }}>{{ $k->kategori }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ $form->active == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $form->active == 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>

                <button type="submit" style="border-radius: 5px" class="btn btn-gradient-primary me-2">Update</button>
                <a href="{{ route('admin.form') }}" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

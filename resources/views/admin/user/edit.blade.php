@extends('layout.main')
@section('title', 'Edit User')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account"></i>
                </span> Edit User
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.user') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit User
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit User</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.user-update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password (leave empty to keep current password)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Pegawai</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="active">Status</label>
                                <select class="form-control" id="active" name="active">
                                    <option value="1" {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ old('active', $user->active) == 2 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" style="border-radius: 5px" class="btn btn-primary">Update User</button>
                            <a href="{{ route('admin.user') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

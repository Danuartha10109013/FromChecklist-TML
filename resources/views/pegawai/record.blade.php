@extends('layout.main')

@section('title')
    Form Submission Records
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-file-document"></i>
                </span> Form Submission Records
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span> Record <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Submission Records</h4>
                        @foreach ($formData as $formName => $submissions)
                            <div class="mb-4">
                                <h5>{{ $formName }}</h5>
                                @foreach ($submissions as $index => $data)
                                    <div class="mt-3">
                                        <h6>Submission {{ $index + 1 }}</h6>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Labels</th>
                                                    <th width="50%">Values</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['labels'] as $fieldId => $label)
                                                    @php
                                                        // Ensure that the index exists in values array
                                                        $value = $data['values'][array_search($fieldId, array_keys($data['labels']))] ?? '';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $label }}</td>
                                                        <td>{{ $valuess }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

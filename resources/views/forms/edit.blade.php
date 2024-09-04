@extends('layout.main')

@section('title', 'Edit Form Field')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-pencil"></i>
                </span> Edit Form Field
            </h3>
        </div>

        <form action="{{route('admin.form-add-update',$formField->id)}}" method="POST" class="forms-sample">
            @csrf
            @method('PUT')

            <div id="input-container" class="mb-4">
                @foreach($labels as $index => $label)
                    <div class="input-group mb-3" id="input-group-{{ $index }}">
                        <div class="form-group me-3 flex-grow-1">
                            <label for="data{{ $index }}" class="form-label">Label {{ $index + 1 }}:</label>
                            <input type="text" class="form-control" id="data{{ $index }}" name="data[]" value="{{ $label }}" placeholder="Enter Label" required>
                        </div>
                        <div class="form-group me-3 flex-grow-1">
                            <label for="type{{ $index }}" class="form-label">Type {{ $index + 1 }}:</label>
                            <select class="form-select" id="type{{ $index }}" name="type[]">
                                <option value="text" {{ $types[$index] == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="number" {{ $types[$index] == 'number' ? 'selected' : '' }}>Number</option>
                                <option value="email" {{ $types[$index] == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="date" {{ $types[$index] == 'date' ? 'selected' : '' }}>Date</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeInputField({{ $index }})">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="row mb-3">
                <div class="col-lg-2">
                    <button type="button" style="border-radius: 5px" class="btn btn-primary" onclick="addInputField()">
                        <i class="mdi mdi-plus"></i> Add More
                    </button>
                </div>
                <div class="col-lg-2">
                    <button type="submit" style="border-radius: 5px" class="btn btn-success">
                        <i class="mdi mdi-check"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var inputCount = {{ count($labels) }};

    function addInputField() {
        inputCount++;
        var container = document.getElementById("input-container");

        var inputGroup = `
            <div class="input-group mb-3" id="input-group-${inputCount}">
                <div class="form-group me-3 flex-grow-1">
                    <label for="data${inputCount}" class="form-label">Label ${inputCount + 1}:</label>
                    <input type="text" class="form-control" id="data${inputCount}" name="data[]" placeholder="Enter Label" required>
                </div>
                <div class="form-group me-3 flex-grow-1">
                    <label for="type${inputCount}" class="form-label">Type ${inputCount + 1}:</label>
                    <select class="form-select" id="type${inputCount}" name="type[]">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="date">Date</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger" onclick="removeInputField(${inputCount})">
                    <i class="mdi mdi-delete"></i>
                </button>
            </div>`;

        container.insertAdjacentHTML('beforeend', inputGroup);
    }

    function removeInputField(index) {
        var inputGroup = document.getElementById('input-group-' + index);
        if (inputGroup) {
            inputGroup.remove();
        }
    }
</script>
@endsection

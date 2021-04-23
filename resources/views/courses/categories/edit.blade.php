@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Role"
            });
        });

    </script>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form action="{{ route('courses.categories.edit', $courseCat->id) }}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control"
                                    value="{{ old('code') ?? $courseCat->code }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') ?? $courseCat->title }}">
                            </div>

                            <div class="form-group">
                                <label for="is_active">Pick Status</label>
                                <select name="is_active" id="roles" class="form-control">
                                    <option {{ $courseCat->is_active == 1 ? 'selected' : '' }} value="1"> active</option>
                                    <option {{ $courseCat->is_active == 0 ? 'selected' : '' }} value="0"> inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-secondary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

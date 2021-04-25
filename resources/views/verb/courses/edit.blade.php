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
                    <div class="card-header">Edit Verbs Course</div>
                    <div class="card-body">
                        <form action="{{ route('verbs.courses.edit', $course->id) }}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') ?? $course->title }}">

                                @error('title')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Pick Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ $course->is_active == 1 ? 'selected' : '' }} value="1">
                                                active</option>
                                            <option {{ $course->is_active == 0 ? 'selected' : '' }} value="0">
                                                inactive</option>
                                        </select>
                                        @error('is_active')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="master_verb_level_id">Pick Verb Level</label>
                                        <select name="master_verb_level_id" id="master_verb_level_id" class="form-control">
                                            <option value="">Select Verb Level</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}"
                                                    {{ $level->id == $course->master_verb_level_id ? 'selected' : '' }}>
                                                    {{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('master_verb_level_id')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

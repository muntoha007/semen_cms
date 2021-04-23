@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select permissions"
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
                    <div class="card-header">Create Letters Category</div>
                    <div class="card-body">
                        <form action="{{ route('courses.categories.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}">
                                @error('code')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div>
    <div class="container-fluid mt--6"> --}}
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="mb-0">Table Letter Categories</span>
                        {{-- <span class="float-right">
                            <a href="{{ route('letters.categories.create') }}" class="btn btn-icon btn-primary btn-sm" type="button">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add</span>
                            </a>
                        </span> --}}
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($courseCats as $index => $cat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cat->code }}</td>
                                    <td>{{ $cat->title }}</td>
                                    <td>{{ $cat->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('courses.categories.edit', $cat) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

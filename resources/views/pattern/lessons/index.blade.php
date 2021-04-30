@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
            });
        });

    </script>
@endpush

@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    {{-- <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">Create Letters Category</div>
                    <div class="card-body">
                        <form action="{{ route('letters.categories.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <button type="submit" class="btn btn-secondary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="mb-0">Table Pattern Lesson</span>
                        <span class="float-right">
                            <button class="btn btn-icon btn-primary btn-sm" type="button" data-toggle="modal"
                                data-target="#modal-default">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add</span>
                            </button>

                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h3 class="modal-title" id="modal-title-default">Add New Pattern Lesson</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('patterns.lessons.create') }}" method="post">
                                                @csrf
                                                @include('pattern.lessons.form-control', ['submit' => 'Create'])
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($lessons as $index => $lesson)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $lesson->code }}</td>
                                    <td>{{ $lesson->name }}</td>
                                    <td>{{ $lesson->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('patterns.lessons.edit', $lesson) }}" class="btn btn-primary btn-sm">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

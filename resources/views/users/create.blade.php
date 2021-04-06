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
                    <div class="card-header">Create User</div>
                    <div class="card-body">
                        <form action="{{ route('assign.create') }}" method="post">
                            @csrf
                            @include('users.partials.form-control')
                            <button type="submit" class="btn btn-secondary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Table of Role & Permission</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th>The Permissions</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->guard_name }}</td>
                                    <td>{{ $role->name == 'super admin' ? 'All' : implode(', ', $role->getPermissionNames()->toArray()) }}
                                    </td>
                                    <td><a href="{{ route('assign.edit', $role) }}">Sync</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

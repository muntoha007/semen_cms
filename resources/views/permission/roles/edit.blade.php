@extends('layouts.back')

@section('content')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0"><strong>Edit Role</strong> </div>
                    <div class="card-body">
                        <form action="{{ route('roles.edit', $role) }}" method="post">
                            @csrf
                            @method('PUT')
                            @include('permission.roles.partials.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

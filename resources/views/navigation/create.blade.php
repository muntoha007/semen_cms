@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create new Navigation</div>
                    <div class="card-body">
                        <form action="{{ route('navigation.create') }}" method="post">
                            @include('navigation.partials.form-control')
                        </form>
                        <button type="submit" class="btn btn-success btn-sm">{{ $submit }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

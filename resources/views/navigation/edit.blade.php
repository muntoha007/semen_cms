@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Navigation</div>
                    <div class="card-body">
                        <form action="{{ route('navigation.edit', $navigation) }}" method="post">
                            @method("PUT")
                            @include('navigation.partials.form-control')
                        </form>

                            <button type="submit" class="btn btn-success btn-sm">{{ $submit }}</button>

                        <div class="float-right">
                            @include('navigation.delete', ['navigation' => $navigation])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

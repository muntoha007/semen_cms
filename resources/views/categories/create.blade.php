@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create new Category</div>
                    <div class="card-body">
                        Hi {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

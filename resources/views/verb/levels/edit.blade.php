@extends('layouts.back')

@section('content')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0"><strong>Edit Levels</strong> </div>
                    <div class="card-body">
                        <form action="{{ route('verbs.levels.edit', $level->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @include('verb.levels.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

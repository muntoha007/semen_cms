@extends('layouts.back')

@section('content')

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0"><strong>Edit Pattern Chapter</strong> </div>
                    <div class="card-body">
                        <form action="{{ route('patterns.chapters.edit', $chapter->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @include('pattern.chapters.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')

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
                    <div class="card-header">Edit Pattern Lesson</div>
                    <div class="card-body">
                        <form action="{{ route('patterns.lessons.edit', $lesson->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @include('pattern.lessons.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

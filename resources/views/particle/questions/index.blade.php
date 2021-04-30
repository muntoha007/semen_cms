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
                <div class="card">
                    <div class="card-header">
                        <span class="mb-0">Table Course Question</span>
                        <span class="float-right">
                            <a href="{{ route('particles.questions.create') }}" class="btn btn-icon btn-primary btn-sm"
                                type="button">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add</span>
                            </a>
                        </span>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($questions as $index => $que)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $que->code }}</td>
                                    <td>{{ $que->question_jpn }}</td>
                                    <td>{{ $que->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('particles.questions.edit', $que) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

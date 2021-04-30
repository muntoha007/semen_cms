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

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="mb-0">Table Verb Sentences</span>
                        <span class="float-right">
                            <a href="{{ route('verbs.sentences.create') }}" class="btn btn-icon btn-primary btn-sm"
                                type="button">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add</span>
                            </a>
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
                                <th>sentence Japan</th>
                                <th>Sentence Romanji</th>
                                <th>Sentence Idn</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($sentences as $index => $sentence)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sentence->code }}</td>
                                    <td>{{ $sentence->sentence_jpn }}</td>
                                    <td>{{ $sentence->sentence_romanji }}</td>
                                    <td>{{ $sentence->sentence_idn }}</td>
                                    <td>{{ $sentence->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('verbs.sentences.edit', $sentence) }}" class="btn btn-primary btn-sm">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

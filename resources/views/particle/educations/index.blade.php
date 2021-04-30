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
                        <span class="mb-0">Table Particle Education</span>
                        <span class="float-right">
                            <button class="btn btn-icon btn-primary btn-sm" type="button" data-toggle="modal"
                                data-target="#modal-default">
                                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i>Add</span>
                            </button>

                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h3 class="modal-title" id="modal-title-default">Add New Particle Education</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('particles.educations.create') }}" method="post">
                                                @csrf
                                                @include('particle.educations.form-control', ['submit' => 'Create'])
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <th>Letter</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($educations as $index => $education)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $education->code }}</td>
                                    <td>{{ $education->letter }}</td>
                                    <td>{{ $education->title }}</td>
                                    <td>{{ $education->description }}</td>
                                    <td>{{ $education->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('particles.educations.edit', $education) }}" class="btn btn-primary btn-sm">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

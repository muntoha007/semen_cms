@extends('layouts.back')

@push('scripts')
    @if (count($errors) > 0)
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal-default').modal('show');
            });

        </script>
    @endif
@endpush

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="mb-0"><strong>Table of Role</strong></span>
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
                                            <h3 class="modal-title" id="modal-title-default">Add New Role</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">X</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('roles.create') }}" method="post">
                                                @csrf
                                                @include('permission.roles.partials.form-control', ['submit' => 'Create'])
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">#</th>
                                    <th scope="col" class="sort" data-sort="budget">Name</th>
                                    <th scope="col" class="sort" data-sort="status">Guard Name</th>
                                    <th scope="col" class="sort" data-sort="completion">Created At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="budget">
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i>
                                                <span class="status">{{ $role->guard_name }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="completion mr-2">{{ $role->created_at->format('d F Y') }}</span>
                                                <div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light {{ $role->name == 'super admin' ? 'disabled' : '' }}"
                                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                                                    <a class="dropdown-item "
                                                        href="{{ route('roles.edit', $role) }}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

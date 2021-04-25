@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select permissions"
            });

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
    {{-- <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">Create Letters Category</div>
                    <div class="card-body">
                        <form action="{{ route('letters.categories.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <button type="submit" class="btn btn-secondary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="mb-0">Table Letter</span>
                        <span class="float-right">
                            <a href="{{ route('letters.letters.create') }}" class="btn btn-icon btn-primary btn-sm"
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
                    {{-- <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Letter</th>
                                <th>Romanji</th>
                                <th>Image</th>
                                <th>Image Color</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($letters as $index => $lcat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $lcat->code }}</td>
                                    <td>{{ $lcat->letter }}</td>
                                    <td>{{ $lcat->romanji }}</td>
                                    <td>
                                        <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder"
                                                src="{{ env('CLOUD_S3_URL') . $lcat->image_url }}">
                                        </span>
                                    </td>
                                    <td>
                                        <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder"
                                                src="{{ $lcat->color_image_url ? env('CLOUD_S3_URL') . $lcat->color_image_url : url('/assets/img/brand/no-img.jpeg') }}">
                                        </span>
                                    </td>
                                    <td>{{ $lcat->is_active ? 'active' : 'inactive' }}</td>
                                    <td><a href="{{ route('letters.letters.edit', $lcat) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div> --}}


                    <div class="card-body">
                        <div class="row">
                            @foreach ($letters as $index => $lcat)
                                <div class="col-md-3">
                                    <div class="card card-stats mt-2 mb-2">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">
                                                        {{ $lcat->romanji }}
                                                    </h5>
                                                    <span class="h2 font-weight-bold mb-0">{{ $lcat->letter }}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="avatar avatar-sm rounded-circle">
                                                        <img alt="img" src="{{ env('CLOUD_S3_URL') . $lcat->image_url }}">
                                                    </span>
                                                    <span class="avatar avatar-sm rounded-circle">
                                                        <img alt="Image placeholder"
                                                            src="{{ $lcat->color_image_url ? env('CLOUD_S3_URL') . $lcat->color_image_url : url('/assets/img/brand/no-img.jpeg') }}">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-0">
                                                <div class="col">
                                                    <span
                                                        class="text-nowrap text-sm">{{ $lcat->is_active ? 'Active' : 'Inactive' }}</span>
                                                </div>
                                                <div class="col">
                                                    <span class="text-success float-right text-sm">
                                                        <a href="{{ route('letters.letters.edit', $lcat) }}"> <i
                                                                class="fa fa-edit"></i> Edit</span> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

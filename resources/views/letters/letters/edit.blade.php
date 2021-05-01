@extends('layouts.back')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Role"
            });
        });

        $(document).ready(function() {
            $('#image_url').change(function() {
                $("#frames").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" style="padding-top: 10px; max-width: 150px; max-height: 150px"/>');
                }
            });

            $('#color_image_url').change(function() {
                $("#frames2").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames2").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" style="padding-top: 10px; max-width: 150px; max-height: 150px;"/>');
                }
            });

            $('input[type="file"][name="image_url"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#lbl1').html(fileName);
            });

            $('input[type="file"][name="color_image_url"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#lbl2').html(fileName);
            });
        });

    </script>
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
                    <div class="card-header">Edit Letter</div>
                    <div class="card-body">
                        <form action="{{ route('letters.letters.edit', $letter->id, ['files' => true]) }}" method="post"
                            enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="letter">Letter</label>
                                        <input type="text" name="letter" id="letter" class="form-control"
                                            value="{{ old('letter') ?? $letter->letter }}">

                                        @error('letter')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="romanji">Romanji</label>
                                        <input type="text" name="romanji" id="romanji" class="form-control"
                                            value="{{ old('romanji') ?? $letter->romanji }}">

                                        @error('romanji')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_stroke">Total Stoke</label>
                                        <input type="number" name="total_stroke" id="total_stroke" class="form-control"
                                            value="{{ old('total_stroke') ?? $letter->total_stroke }}" required>

                                        @error('total_stroke')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($letterCats as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $letter->letter_category_id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ $letter->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ $letter->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <span class="custom-file">
                                            <input type="file" name="image_url" id="image_url" lang="en"
                                                class="custom-file-input" accept="image/jpg, image/png, image/gif">
                                            <label class="custom-file-label" for="image_url"
                                                id="lbl1">{{ $letter->image_url }}</label>
                                        </span>
                                        <div id="frames">
                                            <img src="{{ $letter->image_url ? env('CLOUD_S3_URL') . $letter->image_url : url('/assets/img/brand/no-img.jpeg') }}"
                                                style="padding-top: 10px; max-width: 150px; max-height: 150px" />
                                        </div>
                                        @error('image_url')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image_url">Color Image</label>
                                        <span class="custom-file">
                                            <input type="file" name="color_image_url" id="color_image_url" lang="en"
                                                class="custom-file-input" accept="image/jpg, image/png, image/gif ">
                                            <label class="custom-file-label" for="color_image_url"
                                                id="lbl2">{{ $letter->color_image_url }}</label>
                                        </span>
                                        <div id="frames2"><img
                                                src="{{ $letter->color_image_url ? env('CLOUD_S3_URL') . $letter->color_image_url : url('/assets/img/brand/no-img.jpeg') }}"
                                                style="padding-top: 10px; max-width: 150px; max-height: 115px;" /></div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">{{$submit}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.back')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image_url').change(function() {
                $("#frames").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" style="padding-top: 10px; max-widht: 150px; max-height: 150px"/>');
                }
            });

            $('#color_image_url').change(function() {
                $("#frames2").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames2").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" style="padding-top: 10px; max-widht: 150px; max-height: 150px"/>');
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
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create new Letter</div>
                    <div class="card-body">
                        <form action="{{ route('letters.letters.create', ['files' => true]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="letter">Letter</label>
                                        <input type="text" name="letter" id="letter" class="form-control"
                                            value="{{ old('letter') }}">

                                        @error('letter')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="romanji">Romanji</label>
                                        <input type="text" name="romanji" id="romanji" class="form-control"
                                            value="{{ old('romanji') }}" required>

                                        @error('romanji')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Pick Category</label>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach ($letterCats as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <span class="custom-file">
                                            <input type="file" name="image_url" id="image_url" lang="en"
                                                class="custom-file-input" accept="image/jpg, image/png, image/gif" required>
                                            <label class="custom-file-label" for="image_url" id="lbl1">Choose file</label>
                                        </span>
                                        <div id="frames"></div>
                                        @error('image_url')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_url">Color Image</label>
                                        <span class="custom-file">
                                            <input type="file" name="color_image_url" id="color_image_url" lang="en"
                                                class="custom-file-input" accept="image/jpg, image/png, image/gif ">
                                            <label class="custom-file-label" for="color_image_url" id="lbl2">Choose file</label>
                                        </span>
                                        <div id="frames2"></div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

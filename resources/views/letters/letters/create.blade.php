@extends('layouts.back')

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
                            <div class="form-group">
                                <label for="letter">Letter</label>
                                <input type="text" name="letter" id="letter" class="form-control"
                                    value="{{ old('letter') }}">

                                @error('letter')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="romanji">Romanji</label>
                                <input type="text" name="romanji" id="romanji" class="form-control"
                                    value="{{ old('romanji') }}" required>

                                @error('romanji')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <span class="custom-file">
                                            <input type="file" name="image_url" id="image_url" lang="en"
                                                accept="image/jpg, image/png" required>
                                        </span>
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
                                                accept="image/jpg, image/png">
                                        </span>
                                    </div>
                                </div>
                            </div>


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

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                        <form action="{{ route('letters.letters.edit', $letter->id) }}" method="post">
                            @method("PUT")
                            @csrf
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
                                <label for="image_url">Image Url</label>
                                <input type="text" name="image_url" id="image_url" class="form-control"
                                    value="{{ old('image_url') ?? $letter->image_url }}">
                                @error('image_url')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="color_image_url">Color Image Url</label>
                                <input type="text" name="color_image_url" id="color_image_url" class="form-control"
                                    value="{{ old('color_image_url') ?? $letter->color_image_url }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Pick Category</label>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Pick Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ $letter->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ $letter->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.back')

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sentence_img').change(function() {
                $("#frames").html('');
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    $("#frames").append('<img src="' + window.URL.createObjectURL(this.files[i]) +
                        '" style="padding-top: 10px; max-widht: 150px; max-height: 150px"/>');
                }
            });


            $('input[type="file"][name="sentence_img"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#lbl1').html(fileName);
            });
        });

    </script>
@endpush

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0"><strong>Edit Verb Sentence</strong> </div>
                    <div class="card-body">
                        <form action="{{ route('verbs.sentences.edit', $sentence->id, ['files' => true]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="sentence_jpn">Sentence Japan</label>
                                <input type="text" name="sentence_jpn" id="sentence_jpn" class="form-control"
                                    value="{{ old('sentence_jpn') ?? @$sentence->sentence_jpn }}" required>
                                @error('sentence_jpn')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sentence_romanji">Sentence Romanji</label>
                                <input type="text" name="sentence_romanji" id="sentence_romanji" class="form-control"
                                    value="{{ old('sentence_romanji') ?? @$sentence->sentence_romanji }}" required>
                                @error('sentence_romanji')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sentence_idn">Sentence Indonesia</label>
                                <input type="text" name="sentence_idn" id="sentence_idn" class="form-control"
                                    value="{{ old('sentence_idn') ?? @$sentence->sentence_idn }}" required>
                                @error('sentence_idn')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sentence_jpn_highlight">Sentence Japan Highlight</label>
                                        <input type="text" name="sentence_jpn_highlight" id="sentence_jpn_highlight"
                                            class="form-control"
                                            value="{{ old('sentence_jpn_highlight') ?? @$sentence->sentence_jpn_highlight }}"
                                            required>
                                        @error('sentence_jpn_highlight')
                                            <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sentence_romaji_highlight">Sentence Romanji Highlight</label>
                                        <input type="text" name="sentence_romaji_highlight" id="sentence_romaji_highlight"
                                            class="form-control"
                                            value="{{ old('sentence_romaji_highlight') ?? @$sentence->sentence_romaji_highlight }}"
                                            required>
                                        @error('sentence_romaji_highlight')
                                            <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sentence_img">Image</label>
                                <span class="custom-file">
                                    <input type="file" name="sentence_img" id="sentence_img" lang="en"
                                        class="custom-file-input" accept="image/jpg, image/png, image/gif">
                                    <label class="custom-file-label" for="sentence_img"
                                        id="lbl1">{{ @$sentence->sentence_img }}</label>
                                </span>
                                <div id="frames">
                                    <img src="{{ @$sentence->sentence_img ? env('CLOUD_S3_URL') . @$sentence->sentence_img : url('/assets/img/brand/no-img.jpeg') }}"
                                        style="padding-top: 10px; max-width: 150px; max-height: 150px" />
                                </div>
                                @error('sentence_img')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="verb_change_id">Verbs Change</label>
                                        <select name="verb_change_id" id="verb_change_id"
                                            class="form-control">
                                            <option value="">Select Verbs Change</option>
                                            @foreach ($changes as $change)
                                                <option value="{{ $change->id }}"
                                                    {{ $change->id == $sentence->verb_change_id ? 'selected' : '' }}>
                                                    {{ $change->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('verb_change_id')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ @$sentence->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ @$sentence->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ $submit }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

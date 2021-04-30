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
                    <div class="card-header border-0"><strong>Edit Particle Education</strong> </div>
                    <div class="card-body">
                        <form action="{{ route('particles.educations.details.edit', $detail->id, ['files' => true]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="sentence_jpn">Sentence Japan</label>
                                <input type="text" name="sentence_jpn" id="sentence_jpn" class="form-control"
                                    value="{{ old('sentence_jpn') ?? @$detail->sentence_jpn }}" required>
                                @error('sentence_jpn')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sentence_romanji">Sentence Romanji</label>
                                <input type="text" name="sentence_romanji" id="sentence_romanji" class="form-control"
                                    value="{{ old('sentence_romanji') ?? @$detail->sentence_romanji }}" required>
                                @error('sentence_romanji')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sentence_idn">Sentence Indonesia</label>
                                <input type="text" name="sentence_idn" id="sentence_idn" class="form-control"
                                    value="{{ old('sentence_idn') ?? @$detail->sentence_idn }}" required>
                                @error('sentence_idn')
                                    <div class="text-danger d-block"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sentence_img">Image</label>
                                <span class="custom-file">
                                    <input type="file" name="sentence_img" id="sentence_img" lang="en"
                                        class="custom-file-input" accept="image/jpg, image/png, image/gif">
                                    <label class="custom-file-label" for="sentence_img"
                                        id="lbl1">{{ @$detail->sentence_img }}</label>
                                </span>
                                <div id="frames">
                                    <img src="{{ @$detail->sentence_img ? env('CLOUD_S3_URL') . @$detail->sentence_img : url('/assets/img/brand/no-img.jpeg') }}"
                                        style="padding-top: 10px; max-width: 150px; max-height: 150px" />
                                </div>
                                @error('sentence_img')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="particle_education_id">Particle Education</label>
                                        <select name="particle_education_id" id="particle_education_id"
                                            class="form-control">
                                            <option value="">Select Particle Education</option>
                                            @foreach ($educations as $education)
                                                <option value="{{ $education->id }}"
                                                    {{ $education->id == $detail->particle_education_id ? 'selected' : '' }}>
                                                    {{ $education->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('particle_education_id')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ @$detail->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ @$detail->is_active == 0 ? 'selected' : '' }} value="0"> inactive
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

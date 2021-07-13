@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Add New';
@endphp
@section('title', 'Particle Education Detail' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Particle Education Detail</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('particle-education-details.update', $data->id) : route('particle-education-details.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sentence_jpn">Sentence Japan</label>
                                        <textarea class="form-control" name="sentence_jpn" id="sentence_jpn" rows="4"
                                            placeholder="sentence Japan" required
                                            value="">{{ old('sentence_jpn') ?? @$data->sentence_jpn }}</textarea>
                                        {!! $errors->first('sentence_jpn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="sentence_romanji">Sentence Romanji</label>
                                        <textarea class="form-control" name="sentence_romanji" id="sentence_romanji"
                                            rows="4" placeholder="sentence romanji" required
                                            value="">{{ old('sentence_romanji') ?? @$data->sentence_romanji }}</textarea>
                                        {!! $errors->first('sentence_romanji', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="sentence_idn">Sentence Indonesia</label>
                                        <textarea class="form-control" name="sentence_idn" id="sentence_idn" rows="4"
                                            placeholder="sentence Indonesia" required
                                            value="">{{ old('sentence_idn') ?? @$data->sentence_idn }}</textarea>
                                        {!! $errors->first('sentence_idn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sentence_description">Sentence Description</label>
                                        <textarea class="form-control" name="sentence_description" id="sentence_description"
                                            rows="4" placeholder="sentence Description" required
                                            value="">{{ old('sentence_description') ?? @$data->sentence_description }}</textarea>
                                        {!! $errors->first('sentence_description', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="particle_education_id">Particle Education</label>
                                        <select name="particle_education_id" id="particle_education_id"
                                            class="form-control" required>
                                            <option value="">Select Particle Education</option>
                                            @foreach ($educations as $education)
                                                <option value="{{ $education->id }}"
                                                    {{ $education->id == @$data->particle_education_id ? 'selected' : '' }}>
                                                    {{ $education->title }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('particle_education_id', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option {{ @$data->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ @$data->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                        {!! $errors->first('is_active', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group input-group">
                                        <label for="exampleInputFile">Image</label>
                                        <input type="file"
                                            class="form-control {{ hasErrorField($errors, 'sentence_img') }} dropify"
                                            data-errors-position="outside" name="sentence_img"
                                            data-default-file="{{ env('CLOUD_S3_URL') . @$data->sentence_img }}"
                                            data-height="150" data-max-file-size="4M"
                                            data-allowed-file-extensions="jpg jpeg png gif"
                                            {{ @$type == 'new' ? 'required' : '' }}>
                                    </div>
                                    {!! $errors->first('sentence_img', '<label class="help-block error-validation">:message</label>') !!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                            <a href="{{ route('particle-education-details.index') }}"
                                class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

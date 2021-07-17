@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Particle Test ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Particle Test</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('particle-courses.update', $data->id) : route('particle-courses.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'title') }}"
                                            id="title" name="title" value="{{ old('title', @$data->title) }}"
                                            placeholder="Judul">
                                        {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="test_time">Waktu Test</label>
                                        <input type="number" name="test_time" id="test_time" class="form-control"
                                            value="{{ old('test_time') ?? @$data->test_time }}" required>
                                        {!! $errors->first('test_time', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="particle_education_chapter_id">Bab/Chapter</label>
                                        <select name="particle_education_chapter_id" id="particle_education_chapter_id" class="form-control"
                                            required>
                                            <option value="">Pilih Bab/Chapter</option>
                                            @foreach (@$educations as $edu)
                                                <option value="{{ $edu->id }}"
                                                    {{ $edu->id == @$data->particle_education_chapter_id ? 'selected' : '' }}>
                                                    {{ $edu->title }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('particle_education_chapter_id', '<label class="help-block error-validation">:message</label>') !!}

                                    </div>
                                </div>
                                <div class="col-md-3">
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
                            </div>

                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                            <a href="{{ route('particle-courses.index') }}"
                                class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

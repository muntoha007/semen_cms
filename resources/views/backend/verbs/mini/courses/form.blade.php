@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Kata Kerja Mini ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Kata Kerja Mini</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('verb-mini-courses.update', $data->id) : route('verb-mini-courses.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'title') }}"
                                            id="title" name="title" value="{{ old('title', @$data->title) }}"
                                            placeholder="Judul">
                                        {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="master_verb_level_id">Level</label>
                                        <select name="master_verb_level_id" id="master_verb_level_id" class="form-control"
                                            required>
                                            <option value="">Pilih Level Kata Kerja</option>
                                            @foreach (@$levels as $level)
                                                <option value="{{ $level->id }}"
                                                    {{ $level->id == @$data->master_verb_level_id ? 'selected' : '' }}>
                                                    {{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('master_verb_level_id', '<label class="help-block error-validation">:message</label>') !!}

                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            <a href="{{ route('verb-mini-courses.index') }}"
                                class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

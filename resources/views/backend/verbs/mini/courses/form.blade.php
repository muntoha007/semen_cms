@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Add New';
@endphp
@section('title', 'Verb Mini Course ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Verb Mini Course</h4>
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
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'title') }}"
                                            id="title" name="title" value="{{ old('title', @$data->title) }}"
                                            placeholder="Title">
                                        {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="master_verb_word_id">Words</label>
                                        <select name="master_verb_word_id" id="master_verb_word_id" class="form-control"
                                            required>
                                            <option value="">Select Verb Words</option>
                                            @foreach (@$words as $word)
                                                <option value="{{ $word->id }}"
                                                    {{ $word->id == @$data->master_verb_word_id ? 'selected' : '' }}>
                                                    {{ $word->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('master_verb_word_id', '<label class="help-block error-validation">:message</label>') !!}

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

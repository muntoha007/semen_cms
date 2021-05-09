@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Add New';
@endphp
@section('title', 'Verb Change ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Verb Change</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('verb-changes.update', $data->id) : route('verb-changes.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') ?? @$data->name }}" required>
                                        {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="word_jpn">Word Japan</label>
                                        <input type="text" name="word_jpn" id="word_jpn" class="form-control"
                                            value="{{ old('word_jpn') ?? @$data->word_jpn }}" required>

                                        {!! $errors->first('word_jpn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="word_romanji">Word Romanji</label>
                                        <input type="text" name="word_romanji" id="word_romanji" class="form-control"
                                            value="{{ old('word_romanji') ?? @$data->word_romanji }}" required>

                                        {!! $errors->first('word_romanji', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="word_idn">Word Indonesia</label>
                                        <input type="text" name="word_idn" id="word_idn" class="form-control"
                                            value="{{ old('word_idn') ?? @$data->word_idn }}" required>

                                        {!! $errors->first('word_idn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type_jpn">Type Japan</label>
                                        <input type="text" name="type_jpn" id="type_jpn" class="form-control"
                                            value="{{ old('type_jpn') ?? @$data->type_jpn }}" required>

                                        {!! $errors->first('type_jpn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type_idn">Tipe Indonesia</label>
                                        <input type="text" name="type_idn" id="type_idn" class="form-control"
                                            value="{{ old('type_idn') ?? @$data->type_idn }}" required>

                                        {!! $errors->first('type_idn', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sentence_jpn_highlight">Sentence Japan Highlight</label>
                                        <input type="text" name="sentence_jpn_highlight" id="sentence_jpn_highlight"
                                            class="form-control"
                                            value="{{ old('sentence_jpn_highlight') ?? @$data->sentence_jpn_highlight }}"
                                            required>
                                        {!! $errors->first('sentence_jpn_highlight', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="word_romanji_highlight">Word Romanji Highlight</label>
                                        <input type="text" name="word_romanji_highlight" id="word_romanji_highlight"
                                            class="form-control"
                                            value="{{ old('word_romanji_highlight') ?? @$data->word_romanji_highlight }}"
                                            required>
                                        {!! $errors->first('word_romanji_highlight', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="master_verb_word_id">Pick Verb Word</label>
                                        <select name="master_verb_word_id" id="master_verb_word_id" class="form-control"
                                            required>
                                            <option value="">Select Verb Word</option>
                                            @foreach ($words as $word)
                                                <option value="{{ $word->id }}"
                                                    {{ @$word->id == @$data->master_verb_word_id ? 'selected' : '' }}>
                                                    {{ $word->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('master_verb_word_id', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ @$data->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ @$data->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                    </div>
                                    {!! $errors->first('is_active', '<label class="help-block error-validation">:message</label>') !!}
                                </div>
                            </div>
                            {{-- </div> --}}

                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                            <a href="{{ route('verb-changes.index') }}" class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

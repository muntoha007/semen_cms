@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Pertanyaan ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}Pertanyaan</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('letter-questions.update', $data->id) : route('letter-questions.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            {{-- <div class="row"> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="letter_course_id">Versi Test</label>
                                        <select name="letter_course_id" id="letter" class="form-control" required>
                                            <option value="">Pilih Versi Test</option>
                                            @foreach ($courses as $let)
                                                <option value="{{ $let->id }}"
                                                    {{ $let->id == @$data->letter_course_id ? 'selected' : '' }}>
                                                    {{ $let->title }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('letter_course_id', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ @$data->is_active == 1 ? 'selected' : '' }} value="1">
                                                active
                                            </option>
                                            <option {{ @$data->is_active == 0 ? 'selected' : '' }} value="0">
                                                inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea class="form-control" name="question" id="question" rows="4" placeholder="Question"
                                    required value="">{{ old('question') ?? @$data->question }}</textarea>

                                {!! $errors->first('question', '<label class="help-block error-validation">:message</label>') !!}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer A</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[0][is_true]" value="1"
                                                        {{ ($type == 'new' ? 'checked' : @$answers[0]->is_true == true) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[0][answer]"
                                                value="{{ old('answer[0][answer]') ?? @$answers[0]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[0][id]" name="answer[0][id]" type="hidden"
                                            value="{{ @$answers[0]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer B</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[1][is_true]" value="1"
                                                        {{ @$answers[1]->is_true == true ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[1][answer]"
                                                value="{{ old('answer[1][answer]') ?? @$answers[1]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[1][id]" name="answer[1][id]" type="hidden"
                                            value="{{ @$answers[1]->id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer C</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[2][is_true]" value="1"
                                                        {{ @$answers[2]->is_true == true ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[2][answer]"
                                                value="{{ old('answer[2][answer]') ?? @$answers[2]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[2][id]" name="answer[2][id]" type="hidden"
                                            value="{{ @$answers[2]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer D</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[3][is_true]" value="1"
                                                        {{ @$answers[3]->is_true == true ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[3][answer]"
                                                value="{{ old('answer[3][answer]') ?? @$answers[3]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[3][id]" name="answer[3][id]" type="hidden"
                                            value="{{ @$answers[3]->id }}">
                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}

                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                            <a href="{{ route('letter-questions.index') }}"
                                class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', 'input[type="radio"]', function() {
                $('input[type="radio"]').not(this).prop('checked', false);
            });
        });

    </script>
@endsection

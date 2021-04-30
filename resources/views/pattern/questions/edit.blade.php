@extends('layouts.back')

@push('scripts')
    <script>
        $(document).on('click', 'input[type="checkbox"]', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

    </script>
@endpush

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create new Question</div>
                    <div class="card-body">
                        <form action="{{ route('particles.questions.edit', $question->id) }}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pattern_course_id">Pick Pattern Course</label>
                                        <select name="pattern_course_id" id="pattern_course_id" class="form-control" required>
                                            <option value="">Select Pattern Course</option>
                                            @foreach ($patCourses as $part)
                                                <option value="{{ $part->id }}"
                                                    {{ $part->id == $question->pattern_course_id ? 'selected' : '' }}>
                                                    {{ $part->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('pattern_course_id')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option {{ $question->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ $question->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_jpn">Question Japan</label>
                                        <textarea class="form-control" name="question_jpn" id="question_jpn" rows="4"
                                            placeholder="Question japan" required
                                            value="">{{ old('question_jpn') ?? $question->question_jpn }}</textarea>

                                        @error('question_jpn')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_romanji">Question Romanji</label>
                                        <textarea class="form-control" name="question_romanji" id="question_romanji"
                                            rows="4" placeholder="Question Romanji" required
                                            value="">{{ old('question_romanji') ?? $question->question_romanji }}</textarea>

                                        @error('question_romanji')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_idn">Question Indonesia</label>
                                        <textarea class="form-control" name="question_idn" id="question_idn" rows="4"
                                            placeholder="Question Indonesia" required
                                            value="">{{ old('question_idn') ?? $question->question_idn }}</textarea>

                                        @error('question_idn')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header info">Answer A
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[0][is_true]" value="1"
                                                        {{ $answers[0]->is_true == true ? 'checked' : '' }}>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[0][answer_jpn]') ?? $answers[0]->answer_jpn }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[0][answer_romanji]') ?? $answers[0]->answer_romanji }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[0][answer_idn]') ?? $answers[0]->answer_idn }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="answer[0][id]" name="answer[0][id]" type="hidden"
                                            value="{{ $answers[0]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header">Answer B
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[1][is_true]" value="1"
                                                        {{ $answers[1]->is_true == true ? 'checked' : '' }}>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[1][answer_jpn]') ?? $answers[1]->answer_jpn }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[1][answer_romanji]') ?? $answers[1]->answer_romanji }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[1][answer_idn]') ?? $answers[1]->answer_idn }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="answer[1][id]" name="answer[1][id]" type="hidden"
                                            value="{{ $answers[1]->id }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header">Answer C
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[2][is_true]" value="1"
                                                        {{ $answers[2]->is_true == true ? 'checked' : '' }}>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[2][answer_jpn]') ?? $answers[2]->answer_jpn }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[2][answer_romanji]') ?? $answers[2]->answer_romanji }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[2][answer_idn]') ?? $answers[2]->answer_idn }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="answer[2][id]" name="answer[2][id]" type="hidden"
                                            value="{{ $answers[2]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header">Answer D
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[3][is_true]" value="1"
                                                        {{ $answers[3]->is_true == true ? 'checked' : '' }}>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[3][answer_jpn]') ?? $answers[3]->answer_jpn }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[3][answer_romanji]') ?? $answers[3]->answer_romanji }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[3][answer_idn]') ?? $answers[3]->answer_idn }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="answer[3][id]" name="answer[3][id]" type="hidden"
                                            value="{{ $answers[3]->id }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">{{ $submit }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

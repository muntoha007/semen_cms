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
                        <form action="{{ route('verbs.questions.edit', $question->id) }}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="verb_course_id">Pick Verb Course</label>
                                        <select name="verb_course_id" id="verb_course_id" class="form-control" required>
                                            <option value="">Select Verb Course</option>
                                            @foreach ($verbs as $verb)
                                                <option value="{{ $verb->id }}"
                                                    {{ $verb->id == $question->verb_course_id ? 'selected' : '' }}>
                                                    {{ $verb->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('verb_course_id')
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
                                        <textarea class="form-control" name="question_jpn" id="question_jpn" rows="3"
                                            placeholder="Question Japan" required
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
                                            rows="3" placeholder="Question Romanji" required
                                            value="">{{ old('question_romanji') ?? $question->question_romanji }}</textarea>

                                        @error('question_romanji')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_idn">Question Indonesia</label>
                                        <textarea class="form-control" name="question_idn" id="question_idn" rows="3"
                                            placeholder="Question Indonesia" required
                                            value="">{{ old('question_idn') ?? $question->question_idn }}</textarea>

                                        @error('question_idn')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="question">Answer A</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[0][is_true]" value="1"
                                                {{ $answers[0]->is_true == true ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[0][answer_jpn]"
                                        value="{{ old('answer[0][answer_jpn]') ?? $answers[0]->answer_jpn }}"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[0][answer_idn]"
                                        value="{{ old('answer[0][answer_idn]') ?? $answers[0]->answer_idn }}"
                                        placeholder="answer indonesia" required>
                                </div>
                                <input id="answer[0][id]" name="answer[0][id]" type="hidden"
                                    value="{{ $answers[0]->id }}">
                            </div>
                            <div class="form-group">
                                <label for="question">Answer B</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[1][is_true]" value="1"
                                                {{ $answers[1]->is_true == true ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[1][answer_jpn]"
                                        value="{{ old('answer[1][answer_jpn]') ?? $answers[1]->answer_jpn }}"
                                        placeholder="answer" required>
                                    <input type="text" class="form-control" name="answer[1][answer_idn]"
                                        value="{{ old('answer[1][answer_idn]') ?? $answers[1]->answer_idn }}"
                                        placeholder="answer" required>
                                </div>
                                <input id="answer[1][id]" name="answer[1][id]" type="hidden"
                                    value="{{ $answers[1]->id }}">
                            </div>


                            <div class="form-group">
                                <label for="question">Answer C</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[2][is_true]" value="1"
                                                {{ $answers[2]->is_true == true ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[2][answer_jpn]"
                                        value="{{ old('answer[2][answer_jpn]') ?? $answers[2]->answer_jpn }}"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[2][answer_idn]"
                                        value="{{ old('answer[2][answer_idn]') ?? $answers[2]->answer_idn }}"
                                        placeholder="answer indonesia" required>
                                </div>
                                <input id="answer[2][id]" name="answer[2][id]" type="hidden"
                                    value="{{ $answers[2]->id }}">
                            </div>

                            <div class="form-group">
                                <label for="question">Answer D</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[3][is_true]" value="1"
                                                {{ $answers[3]->is_true == true ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[3][answer_jpn]"
                                        value="{{ old('answer[3][answer_jpn]') ?? $answers[3]->answer_jpn }}"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[3][answer_idn]"
                                        value="{{ old('answer[3][answer_idn]') ?? $answers[3]->answer_idn }}"
                                        placeholder="answer indonesia" required>
                                </div>
                                <input id="answer[3][id]" name="answer[3][id]" type="hidden"
                                    value="{{ $answers[3]->id }}">
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

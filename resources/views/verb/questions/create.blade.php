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
                        <form action="{{ route('verbs.questions.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="verb_course_id">Pick Verb Course</label>
                                <select name="verb_course_id" id="verb_course_id" class="form-control" required>
                                    <option value="">Select Verb Course</option>
                                    @foreach ($verbs as $verb)
                                        <option value="{{ $verb->id }}">{{ $verb->title }}</option>
                                    @endforeach
                                </select>
                                @error('verb_course_id')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_jpn">Question Japan</label>
                                        <textarea class="form-control" name="question_jpn" id="question_jpn" rows="3"
                                            placeholder="Question japan" required
                                            value="">{{ old('question_jpn') }}</textarea>

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
                                            value="">{{ old('question_romanji') }}</textarea>

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
                                            value="">{{ old('question_idn') }}</textarea>

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
                                                title="Choose as answer" name="answer[0][is_true]" value="1" checked>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[0][answer_jpn]"
                                        placeholder="Answer Japan" required>
                                    <input type="text" class="form-control" name="answer[0][answer_idn]"
                                        placeholder="Answer Indonesia" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question">Answer B</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[1][is_true]" value="1">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[1][answer_jpn]"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[1][answer_idn]"
                                        placeholder="answer indonesia" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="question">Answer C</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[2][is_true]" value="1">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[2][answer_jpn]"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[2][answer_idn]"
                                        placeholder="answer indonesia" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question">Answer D</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                title="Choose as answer" name="answer[3][is_true]" value="1">
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="answer[3][answer_jpn]"
                                        placeholder="answer japan" required>
                                    <input type="text" class="form-control" name="answer[3][answer_idn]"
                                        placeholder="answer indonesia" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

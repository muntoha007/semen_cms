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
                    <div class="card-header">Create New Pattern Course Question</div>
                    <div class="card-body">
                        <form action="{{ route('patterns.questions.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="pattern_course_id">Pattern Course</label>
                                <select name="pattern_course_id" id="pattern_course_id" class="form-control" required>
                                    <option value="">Select Pattern Course</option>
                                    @foreach ($patCourses as $pat)
                                        <option value="{{ $pat->id }}">{{ $pat->title }}</option>
                                    @endforeach
                                </select>
                                @error('pattern_course_id')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_jpn">Question Japan</label>
                                        <textarea class="form-control" name="question_jpn" id="question_jpn" rows="5"
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
                                            rows="5" placeholder="Question Romanji" required
                                            value="">{{ old('question_romanji') }}</textarea>

                                        @error('question_romanji')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="question_idn">Question Indonesia</label>
                                        <textarea class="form-control" name="question_idn" id="question_idn" rows="5"
                                            placeholder="Question Indonesia" required
                                            value="">{{ old('question_idn') }}</textarea>

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
                                            <div class="card-header">Answer A
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[0][is_true]" value="1"
                                                        checked>
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[0][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[0][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[0][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[0][answer]') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header">Answer B
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[1][is_true]" value="1">
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[1][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[1][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[1][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[1][answer]') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
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
                                                        title="Choose as answer" name="answer[2][is_true]" value="1">
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[2][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[2][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[2][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[2][answer]') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header">Answer D
                                                <span class="float-right">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[3][is_true]" value="1">
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_jpn]"
                                                        placeholder="answer japan"
                                                        required>{{ old('answer[3][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_romanji]"
                                                        placeholder="answer romanji"
                                                        required>{{ old('answer[3][answer]') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3" name="answer[3][answer_idn]"
                                                        placeholder="answer indonesia"
                                                        required>{{ old('answer[3][answer]') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

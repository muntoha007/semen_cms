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
                        <form action="{{ route('letters.questions.edit', $question->id) }}" method="post">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="letter">Pick Letter</label>
                                        <select name="letter" id="letter" class="form-control" required>
                                            <option value="">Select letter</option>
                                            @foreach ($letters as $let)
                                                <option value="{{ $let->id }}"
                                                    {{ $let->id == $question->letter_course_id ? 'selected' : '' }}>
                                                    {{ $let->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('letter')
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

                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea class="form-control" name="question" id="question" rows="3" placeholder="Question"
                                    required value="">{{ old('question') ?? $question->question }}</textarea>

                                @error('question')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
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
                                            <input type="text" class="form-control" name="answer[0][answer]"
                                                value="{{ old('answer[0][answer]') ?? $answers[0]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[0][id]" name="answer[0][id]" type="hidden"
                                            value="{{ $answers[0]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                            <input type="text" class="form-control" name="answer[1][answer]"
                                                value="{{ old('answer[1][answer]') ?? $answers[1]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[1][id]" name="answer[1][id]" type="hidden"
                                            value="{{ $answers[1]->id }}">
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
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[2][is_true]" value="1"
                                                        {{ $answers[2]->is_true == true ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[2][answer]"
                                                value="{{ old('answer[2][answer]') ?? $answers[2]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[2][id]" name="answer[2][id]" type="hidden"
                                            value="{{ $answers[2]->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                            <input type="text" class="form-control" name="answer[3][answer]"
                                                value="{{ old('answer[3][answer]') ?? $answers[3]->answer }}"
                                                placeholder="answer" required>
                                        </div>
                                        <input id="answer[3][id]" name="answer[3][id]" type="hidden"
                                            value="{{ $answers[3]->id }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

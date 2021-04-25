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
                        <form action="{{ route('letters.questions.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="letter">Pick Letter</label>
                                <select name="letter" id="letter" class="form-control" required>
                                    <option value="">Select Letter</option>
                                    @foreach ($letters as $letter)
                                        <option value="{{ $letter->id }}">{{ $letter->title }}</option>
                                    @endforeach
                                </select>
                                @error('letter')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="question">Question</label>
                                <textarea class="form-control" name="question" id="question" rows="3" placeholder="Question"
                                    required value="">{{ old('question') }}</textarea>

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
                                                        title="Choose as answer" name="answer[0][is_true]" value="1" checked>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[0][answer]"
                                                placeholder="answer" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer B</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[1][is_true]" value="1">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[1][answer]"
                                                placeholder="answer" required>
                                        </div>
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
                                                        title="Choose as answer" name="answer[2][is_true]" value="1">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[2][answer]"
                                                placeholder="answer" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="question">Answer D</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" data-toggle="tooltip" data-placement="top"
                                                        title="Choose as answer" name="answer[3][is_true]" value="1">
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="answer[3][answer]"
                                                placeholder="answer" required>
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

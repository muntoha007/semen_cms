@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create new Verb Course</div>
                    <div class="card-body">
                        <form action="{{ route('verbs.courses.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}">

                                @error('title')
                                    <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Pick Status</label>
                                        <select name="is_active" id="status" class="form-control">
                                            <option value="1"> active</option>
                                            <option value="0"> inactive</option>
                                        </select>
                                        @error('is_active')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="master_verb_level_id">Pick Level</label>
                                        <select name="master_verb_level_id" id="master_verb_level_id" class="form-control">
                                            <option value="">Select Level</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('master_verb_level_id')
                                            <div class="text-danger mt-2 d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

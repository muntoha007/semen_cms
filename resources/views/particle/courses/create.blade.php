@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Create New Particle Course</div>
                    <div class="card-body">
                        <form action="{{ route('particles.courses.create') }}" method="post">
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
                                        <label for="particle_education_id">Particle Education</label>
                                        <select name="particle_education_id" id="particle_education_id" class="form-control">
                                            <option value="">Select Particle Education</option>
                                            @foreach ($educations as $edu)
                                                <option value="{{ $edu->id }}">{{ $edu->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('particle_education_id')
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

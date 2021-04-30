<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? @$course->title }}"
        required>
    @error('title')
        <div class="text-danger d-block"><small>{{ $message }}</small></div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$course->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$course->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>




<button type="submit" class="btn btn-primary">{{ $submit }}</button>

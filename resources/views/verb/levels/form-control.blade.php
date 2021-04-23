<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? @$level->name }}">
            @error('name')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$level->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$level->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>




<button type="submit" class="btn btn-primary">{{ $submit }}</button>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? @$group->name }}"
                required>
            @error('name')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$group->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$group->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="category">Pick Verb Level</label>
    <select name="level" id="level" class="form-control" required>
        <option value="">Select Level</option>
        @foreach ($levels as $level)
            <option value="{{ $level->id }}" {{ @$level->id == @$group->master_verb_level_id ? 'selected' : '' }}>
                {{ $level->name }}</option>
        @endforeach
    </select>
    @error('level')
        <div class="text-danger mt-2 d-block">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit }}</button>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? @$lesson->name }}"
        required>
    @error('name')
        <div class="text-danger d-block"><small>{{ $message }}</small></div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Pick Verb Level</label>
            <select name="pattern_chapter_id" id="pattern_chapter_id" class="form-control" required>
                <option value="">Select Verb Level</option>
                @foreach ($chapters as $chapter)
                    <option value="{{ $chapter->id }}"
                        {{ @$chapter->id == @$lesson->pattern_chapter_id ? 'selected' : '' }}>
                        {{ $chapter->name }}</option>
                @endforeach
            </select>
            @error('pattern_chapter_id')
                <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$lesson->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$lesson->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>




<button type="submit" class="btn btn-primary">{{ $submit }}</button>

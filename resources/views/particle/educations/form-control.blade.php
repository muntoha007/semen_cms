<div class="form-group">
    <label for="letter">Letter</label>
    <input type="text" name="letter" id="letter" class="form-control"
        value="{{ old('letter') ?? @$education->letter }}" required>
    @error('letter')
        <div class="text-danger d-block"><small>{{ $message }}</small></div>
    @enderror
</div>

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? @$education->title }}" required>
    @error('title')
        <div class="text-danger d-block"><small>{{ $message }}</small></div>
    @enderror
</div>


<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description" required
        value="{{ old('decription') ?? @$education->description }}">{{ old('description') ?? @$education->description }}</textarea>

    @error('description')
        <div class="text-danger mt-2 d-block">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="is_active">Status</label>
    <select name="is_active" id="status" class="form-control">
        <option {{ @$education->is_active == 1 ? 'selected' : '' }} value="1"> active
        </option>
        <option {{ @$education->is_active == 0 ? 'selected' : '' }} value="0"> inactive
        </option>
    </select>
</div>


<button type="submit" class="btn btn-primary">{{ $submit }}</button>

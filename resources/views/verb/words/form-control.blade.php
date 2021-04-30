<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? @$word->name }}"
                required>
            @error('name')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_japan">Word Japan</label>
            <input type="text" name="word_japan" id="word_japan" class="form-control"
                value="{{ old('word_japan') ?? @$word->word_japan }}" required>
            @error('word_japan')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_romanji">Word Romanji</label>
            <input type="text" name="word_romanji" id="word_romanji" class="form-control"
                value="{{ old('word_romanji') ?? @$word->word_romanji }}" required>
            @error('word_romanji')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_idn">Word Indonesia</label>
            <input type="text" name="word_idn" id="word_idn" class="form-control"
                value="{{ old('word_idn') ?? @$word->word_idn }}" required>
            @error('word_idn')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Pick Verb Level</label>
            <select name="master_verb_level_id" id="master_verb_level_id" class="form-control" required>
                <option value="">Select Verb Level</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}"
                        {{ @$level->id == @$word->master_verb_level_id ? 'selected' : '' }}>
                        {{ $level->name }}</option>
                @endforeach
            </select>
            @error('master_verb_level_id')
                <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Pick Verb Group</label>
            <select name="master_verb_group_id" id="master_verb_group_id" class="form-control" required>
                <option value="">Select Verb Group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}"
                        {{ @$group->id == @$word->master_verb_group_id ? 'selected' : '' }}>
                        {{ $group->name }}</option>
                @endforeach
            </select>
            @error('master_verb_group_id')
                <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$word->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$word->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>




<button type="submit" class="btn btn-primary">{{ $submit }}</button>

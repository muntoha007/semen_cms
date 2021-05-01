<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? @$change->name }}"
                required>
            @error('name')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_jpn">Word Japan</label>
            <input type="text" name="word_jpn" id="word_jpn" class="form-control"
                value="{{ old('word_jpn') ?? @$change->word_jpn }}" required>
            @error('word_jpn')
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
                value="{{ old('word_romanji') ?? @$change->word_romanji }}" required>
            @error('word_romanji')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_idn">Word Indonesia</label>
            <input type="text" name="word_idn" id="word_idn" class="form-control"
                value="{{ old('word_idn') ?? @$change->word_idn }}" required>
            @error('word_idn')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_jpn">Type Japan</label>
            <input type="text" name="type_jpn" id="type_jpn" class="form-control"
                value="{{ old('type_jpn') ?? @$change->type_jpn }}">
            @error('type_jpn')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_idn">Type Indonesia</label>
            <input type="text" name="type_idn" id="type_idn" class="form-control"
                value="{{ old('type_idn') ?? @$change->type_idn }}">
            @error('type_idn')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="sentence_jpn_highlight">Sentence Japan Highlight</label>
            <input type="text" name="sentence_jpn_highlight" id="sentence_jpn_highlight"
                class="form-control"
                value="{{ old('sentence_jpn_highlight') ?? @$change->sentence_jpn_highlight }}"
                required>
            @error('sentence_jpn_highlight')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="word_romanji_highlight">Word Romanji Highlight</label>
            <input type="text" name="word_romanji_highlight" id="word_romanji_highlight"
                class="form-control"
                value="{{ old('word_romanji_highlight') ?? @$change->word_romanji_highlight }}"
                required>
            @error('word_romanji_highlight')
                <div class="text-danger d-block"><small>{{ $message }}</small></div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="master_verb_word_id">Pick Verb Word</label>
            <select name="master_verb_word_id" id="master_verb_word_id" class="form-control" required>
                <option value="">Select Verb Word</option>
                @foreach ($words as $word)
                    <option value="{{ $word->id }}"
                        {{ @$word->id == @$change->master_verb_word_id ? 'selected' : '' }}>
                        {{ $word->name }}</option>
                @endforeach
            </select>
            @error('master_verb_word_id')
                <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="status" class="form-control">
                <option {{ @$change->is_active == 1 ? 'selected' : '' }} value="1"> active
                </option>
                <option {{ @$change->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                </option>
            </select>
        </div>
    </div>
</div>




<button type="submit" class="btn btn-primary">{{ $submit }}</button>

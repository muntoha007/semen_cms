<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="password">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="password-confirm">{{ __('Confirm Password') }}</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
        autocomplete="new-password">
</div>

<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control">
        <option disabled selected>Choose a role!</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role')
        <div class="text-danger mt-2 d-block">{{ $message }}</div>
    @enderror
</div>

{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}

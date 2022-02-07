@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Driver ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Driver</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('driver.update', $data->id) : route('driver.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name">Nama Lengkap</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'full_name') }}"
                                            id="full_name" name="full_name"
                                            value="{{ old('full_name', @$data->full_name) }}" placeholder="Nama Lengkap">
                                        {!! $errors->first('full_name', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="identity_number">Nomor Identitas</label>
                                        <input type="number"
                                            class="form-control {{ hasErrorField($errors, 'identity_number') }}"
                                            id="identity_number" name="identity_number"
                                            value="{{ old('identity_number', @$data->identity_number) }}"
                                            placeholder="Nomor Identitas">
                                        {!! $errors->first('identity_number', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor HP</label>
                                        <input type="number" class="form-control {{ hasErrorField($errors, 'phone') }}"
                                            id="phone" name="phone" value="{{ old('phone', @$data->phone) }}"
                                            placeholder="Nomor HP">
                                        {!! $errors->first('phone', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'email') }}"
                                            id="email" name="email" value="{{ old('email', @$data->email) }}"
                                            placeholder="Email">
                                        {!! $errors->first('email', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    @if (@$data->id < 1)
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control {{ hasErrorField($errors, 'password') }}"
                                                id="password" name="password"
                                                value="{{ old('password', @$data->password) }}" placeholder="Password">
                                            {!! $errors->first('password', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control" name="address" id="address" rows="3"
                                            placeholder="Alamat" required
                                            value="">{{ old('address') ?? @$data->address }}</textarea>

                                        {!! $errors->first('address', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active" class="form-control">
                                            <option {{ @$data->is_active == 1 ? 'selected' : '' }} value="1"> active
                                            </option>
                                            <option {{ @$data->is_active == 0 ? 'selected' : '' }} value="0"> inactive
                                            </option>
                                        </select>
                                        {!! $errors->first('is_active', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                            <a href="{{ route('driver.index') }}" class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

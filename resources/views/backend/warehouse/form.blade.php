@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Gudang ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Gudang</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('warehouse.update', $data->id) : route('warehouse.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'name') }}"
                                            id="name" name="name" value="{{ old('name', @$data->name) }}"
                                            placeholder="Nama">
                                        {!! $errors->first('name', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Nomor HP</label>
                                        <input type="number" class="form-control {{ hasErrorField($errors, 'phone') }}"
                                            id="phone" name="phone" value="{{ old('phone', @$data->phone) }}"
                                            placeholder="Nomor HP">
                                        {!! $errors->first('phone', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select name="province_id" id="province_id" class="form-control" required>
                                            <option value="">Pilih Provinsi</option>
                                            @foreach (@$provinces as $prov)
                                                @if (old('province_id', @$data->province_id) == $prov->id)
                                                    <option value="{{ $prov->id }}" selected>{{ $prov->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        {!! $errors->first('province_id', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="regency_id">Kecamatan</label>
                                        <select name="regency_id" id="regency_id" class="form-control" required>
                                            <option value="{{ old('regency_id') }}">Pilih Kecamatan</option>
                                            @foreach (@$regencies as $reg)
                                                @if (old('regency_id', @$data->regency_id) == $reg->id)
                                                    <option value="{{ $reg->id }}" selected>{{ $reg->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        {!! $errors->first('regency_id', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input type="text"
                                                    class="form-control {{ hasErrorField($errors, 'longitude') }}"
                                                    id="longitude" name="longitude"
                                                    value="{{ old('longitude', @$data->longitude) }}"
                                                    placeholder="Longitude">
                                                {!! $errors->first('longitude', '<label class="help-block error-validation">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="latitude">Latitude</label>
                                                <input type="text"
                                                    class="form-control {{ hasErrorField($errors, 'latitude') }}"
                                                    id="latitude" name="latitude"
                                                    value="{{ old('latitude', @$data->latitude) }}"
                                                    placeholder="Latitude">
                                                {!! $errors->first('latitude', '<label class="help-block error-validation">:message</label>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control" name="address" id="address" rows="3"
                                            placeholder="Alamat" required
                                            value="">{{ old('address') ?? @$data->address }}</textarea>

                                        {!! $errors->first('address', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status Aktif</label>
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
                            <a href="{{ route('warehouse.index') }}" class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

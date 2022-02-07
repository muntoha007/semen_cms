@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Kendaraan ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Kendaraan</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('vehicle.update', $data->id) : route('vehicle.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'brand') }}"
                                            id="brand" name="brand" value="{{ old('brand', @$data->brand) }}"
                                            placeholder="Brand">
                                        {!! $errors->first('brand', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="production_year">Tahun Produksi</label>
                                        <input type="number"
                                            class="form-control {{ hasErrorField($errors, 'production_year') }}"
                                            id="production_year" name="production_year"
                                            value="{{ old('production_year', @$data->production_year) }}"
                                            placeholder="Tahun Produksi">
                                        {!! $errors->first('production_year', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="plate_number">Nomor Plate</label>
                                        <input type="text"
                                            class="form-control {{ hasErrorField($errors, 'plate_number') }}"
                                            id="plate_number" name="plate_number"
                                            value="{{ old('plate_number', @$data->plate_number) }}"
                                            placeholder="Nomor Plate">
                                        {!! $errors->first('plate_number', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="date_plate">Tanggal Plate</label>
                                        <input type="text" class="datetimepicker form-control {{ hasErrorField($errors, 'date_plate') }}"
                                            id="date_plate" name="date_plate"
                                            value="{{ old('date_plate', @$data->date_plate) }}"
                                            placeholder="Tanggal Plate">
                                        {!! $errors->first('date_plate', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="date_kir">Tanggal KIR</label>
                                        <input type="text" class="datetimepicker form-control {{ hasErrorField($errors, 'date_kir') }}"
                                            id="date_kir" name="date_kir" value="{{ old('date_kir', @$data->date_kir) }}"
                                            placeholder="Tanggal KIR">
                                        {!! $errors->first('date_kir', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="capacity">Kapasitas</label>
                                        <input type="number"
                                            class="form-control {{ hasErrorField($errors, 'capacity') }}" id="capacity"
                                            name="capacity" value="{{ old('capacity', @$data->capacity) }}"
                                            placeholder="Kapasitas">
                                        {!! $errors->first('capacity', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Tipe</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'type') }}"
                                            id="type" name="type" value="{{ old('type', @$data->type) }}"
                                            placeholder="Tipe">
                                        {!! $errors->first('type', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status Booking</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ @$data->status == 'FREE' ? 'selected' : '' }} value="FREE"> Free
                                            </option>
                                            <option {{ @$data->status == 'BOOKED' ? 'selected' : '' }} value="BOOKED">
                                                Booked
                                            </option>
                                        </select>
                                        {!! $errors->first('status', '<label class="help-block error-validation">:message</label>') !!}
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
                            <a href="{{ route('vehicle.index') }}" class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@script
<script type="text/javascript">
    $('.date').datepicker({
       format: 'mm-dd-yyyy'
     });
</script>
@endscript

@extends('layouts.master')
@section('title', 'Kendaraan List')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @isPermitted('vehicle.create')
                        <div class="form-group">
                            <a href="{{ route('vehicle.create') }}" type="button" class="btn btn-outline-info btn-rounded btn-fw btn-sm">
                                <i class="mdi mdi-plus-circle btn-icon-prepend"></i> Tambah
                            </a>
                        </div>
                        @endisPermitted
                        <h4 class="card-title text-center table-title">List Kendaraan</h4>
                        <br>
                        <div class="col-md-12">
                            {!! $dataTable->table(['class'=>'table table-hover table-responsive-lg','id' => 'app'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="assign-driver-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Assign Driver</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <form class="forms-sample"
                            action="{{ route('driver-vehicle.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <select name="driver_id" id="driver_id" class="form-control" required>
                                <option value="">Pilih Driver</option>
                                @foreach (@$drivers as $driver)
                                    @if (old('driver_id', @$data->driver_id) == $driver->id)
                                        <option value="{{ $driver->id }}" selected>
                                            {{ $driver->full_name }}
                                        </option>
                                    @else
                                        <option value="{{ $driver->id }}">{{ $driver->full_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('driver_id', '<label class="help-block error-validation">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" name="notes" id="notes" rows="3"
                                placeholder="Notes" required
                                value="">{{ old('notes') ?? @$data->notes }}</textarea>

                            {!! $errors->first('notes', '<label class="help-block error-validation">:message</label>') !!}
                        </div>
                    </div>
                    <div class="modal-footer">

                        <a id="assign-modal-cancel" href="#" class="btn btn-default pull-left" data-dismiss="modal">
                            <i class="fa fa-times m-right-10"></i> Cancel
                        </a>
                        <button class="btn btn-success" id="submit" type="submit">
                            <i class="fa fa-check m-right-10"></i> Assign
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection

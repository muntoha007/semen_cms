@extends('layouts.master')
@section('title', 'Delivery Order List')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center table-title">Daftar Delivery Order</h4>
                        @isPermitted('delivery-order.create')
                        <div class="form-group">
                            <a href="{{ route('delivery-order.create') }}" type="button"
                                class="btn btn-outline-info btn-rounded btn-fw btn-sm">
                                <i class="mdi mdi-plus-circle btn-icon-prepend"></i> Tambah
                            </a>
                        </div>
                        @endisPermitted
                        <br>
                        <div class="col-md-12">
                            {!! $dataTable->table(['class' => 'table table-hover table-responsive-lg', 'id' => 'app'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="assign-modal" class="modal fade">
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
                                action="{{ route('assign') }}"
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
    </div>
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection

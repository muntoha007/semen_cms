@extends('layouts.master')
@php
$title = @$data ? 'Edit' : 'Tambah';
@endphp
@section('title', 'Delivery Order ' . $title)
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }} Delivery Order</h4>
                        <br>
                        <form class="forms-sample"
                            action="{{ @$data ? route('delivery-order.update', $data->id) : route('delivery-order.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (@$data)
                                <input type="hidden" name="_method" value="put">
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="booking_code">Kode Booking</label>
                                        <input type="text"
                                            class="form-control {{ hasErrorField($errors, 'booking_code') }}"
                                            id="booking_code" name="booking_code"
                                            value="{{ old('booking_code', @$data->booking_code) }}"
                                            placeholder="Kode Booking" required>
                                        {!! $errors->first('booking_code', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="number_reference">Nomor Ref</label>
                                        <input type="text"
                                            class="form-control {{ hasErrorField($errors, 'number_reference') }}"
                                            id="number_reference" name="number_reference"
                                            value="{{ old('number_reference', @$data->number_reference) }}"
                                            placeholder="Nomor Ref" required>
                                        {!! $errors->first('number_reference', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="distributor">Distributor</label>
                                        <input type="text"
                                            class="form-control {{ hasErrorField($errors, 'distributor') }}"
                                            id="distributor" name="distributor"
                                            value="{{ old('distributor', @$data->distributor) }}"
                                            placeholder="Distributor" required>
                                        {!! $errors->first('distributor', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="store">Toko</label>
                                        <input type="text" class="form-control {{ hasErrorField($errors, 'store') }}"
                                            id="store" name="store" value="{{ old('store', @$data->store) }}"
                                            placeholder="Toko" required>
                                        {!! $errors->first('store', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="booking_date">Tanggal Booking</label>
                                                <input type="text"
                                                    class="datetimepicker form-control {{ hasErrorField($errors, 'booking_date') }}"
                                                    id="booking_date" name="booking_date"
                                                    value="{{ old('booking_date', @$data->booking_date) }}"
                                                    placeholder="Tanggal Booking">
                                                {!! $errors->first('booking_date', '<label class="help-block error-validation">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="expired_date">Tanggal Kadaluarsa</label>
                                                <input type="text"
                                                    class="datetimepicker form-control {{ hasErrorField($errors, 'expired_date') }}"
                                                    id="expired_date" name="expired_date"
                                                    value="{{ old('expired_date', @$data->expired_date) }}"
                                                    placeholder="Tanggal Kadaluarsa">
                                                {!! $errors->first('expired_date', '<label class="help-block error-validation">:message</label>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="atatus">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ @$data->atatus == 0 ? 'selected' : '' }} value="CREATED"> CREATED
                                            </option>
                                            <option {{ @$data->atatus == 1 ? 'selected' : '' }} value="BOOKED"> BOOKED
                                            </option>
                                        </select>
                                        {!! $errors->first('status', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="do_file">File</label>
                                        <input type="file" class="form-control {{ hasErrorField($errors, 'do_file') }}"
                                            id="do_file" name="do_file" value="{{ old('do_file', @$data->do_file) }}"
                                            placeholder="File">
                                        {!! $errors->first('do_file', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">Catatan</label>
                                        <textarea class="form-control" name="notes" id="notes" rows="3"
                                            placeholder="Catatan" required
                                            value="">{{ old('notes') ?? @$data->notes }}</textarea>

                                        {!! $errors->first('notes', '<label class="help-block error-validation">:message</label>') !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br />
                                    <h4 class="card-title">{{ $title }} Produk</h4>
                                    <span class="d-inline pull-right form-group">
                                        <i class="btn btn-sm btn-success mdi mdi-plus-box" id="addprod"></i>
                                    </span>
                                    <br />

                                    <div class="row" id="dinamic_prod">
                                        @foreach ($details as $key => $item)
                                            <div class="col-md-6" id="row_prod{{$key}}">
                                                <div class="form-group">
                                                    <label for="product_id">Produk</label>
                                                    <select name="products[{{ $key }}][product_id]"
                                                        id="product_id" class="form-control" required>
                                                        <option value="">Pilih Produk</option>
                                                        @foreach (@$products as $prod)
                                                            @if (old('product_id', @$item->product_id) == $prod->id)
                                                                <option value="{{ $prod->id }}" selected>
                                                                    {{ $prod->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $prod->id }}">{{ $prod->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    {!! $errors->first('product_id', '<label class="help-block error-validation">:message</label>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Jumlah</label>
                                                    <input type="number"
                                                        class="form-control {{ hasErrorField($errors, 'quantity') }}"
                                                        id="quantity" name="products[{{ $key }}][quantity]"
                                                        value="{{ $item['quantity'] }}" placeholder="Jumlah" required>
                                                    {!! $errors->first('quantity', '<label class="help-block error-validation">:message</label>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="weight">Berat</label>
                                                    <input type="number"
                                                        class="form-control {{ hasErrorField($errors, 'weight') }}"
                                                        id="weight" name="products[{{ $key }}][weight]"
                                                        value="{{ $item['weight'] }}" placeholder="Berat" required>
                                                    {!! $errors->first('weight', '<label class="help-block error-validation">:message</label>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes">Catatan</label>
                                                    <textarea class="form-control"
                                                        name="products[{{ $key }}][notes]" id="pnotes" rows="3"
                                                        placeholder="Catatan" required
                                                        value="">{{ $item['notes'] }}</textarea>

                                                    {!! $errors->first('notes', '<label class="help-block error-validation">:message</label>') !!}
                                                </div>
                                                <input type="hidden" name="products[{{ $key }}][id]"
                                                    value="{{ $item['id'] }} ">
                                                <div>
                                                    <button class="btn btn-sm btn-danger mdi mdi-minus-box btn_removeprod"
                                                        type="button" id="{{ $key }}" {{ count($details) <= 1 ? 'disabled' : '' }}></button>
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            {{-- </div> --}}


                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                                <a href="{{ route('delivery-order.index') }}"
                                    class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;
            $('#addprod').click(function() {
                i++
                var clonedDiv = $('#dinamic_prod').append(
                    '<div class="col-md-6" id="row_prod'+i+'"> <div class="form-group"> <label for="product_id">Produk</label> <select name="products[' +
                    i +
                    '][product_id]" id="product_id" class="form-control" required> <option value="">Pilih Produk</option> @foreach (@$products as $prod) @if (old('product_id', @$item->product_id) == $prod->id)<option value="{{ $prod->id }}" selected> {{ $prod->name }}</option> @else <option value="{{ $prod->id }}">{{ $prod->name }}</option> @endif @endforeach </select> </div> <div class="form-group"> <label for="quantity">Jumlah</label> <input type="number" class="form-control {{ hasErrorField($errors, 'quantity') }}" id="quantity" name="products[' +
                    i +
                    '][quantity]" value="" placeholder="Jumlah" required> </div> <div class="form-group"> <label for="weight">Berat</label> <input type="number" class="form-control {{ hasErrorField($errors, 'weight') }}" id="weight" name="products[' +
                    i +
                    '][weight]" value="" placeholder="Berat" required>  </div> <div class="form-group"> <label for="notes">Catatan</label> <textarea class="form-control" name="products[' +
                    i +
                    '][notes]" id="pnotes" rows="3" placeholder="Catatan" required value=""></textarea>  </div>  <div> <button class="btn btn-sm btn-danger mdi mdi-minus-box btn_removeprod" type="button" id="' +
                    i + '"></button><hr> </div>');

                    if ($(".btn_removeprod").length > 1) {
                    $(".btn_removeprod").removeAttr('disabled');
                }
            });

            $(document).on('click', '.btn_removeprod', function() {
                var button_id = $(this).attr("id");
                $('#row_prod' + button_id + '').remove();

                if ($(".btn_removeprod").length <= 1) {
                    $(".btn_removeprod").attr('disabled', 'disabled');
                }
            });


        });
    </script>
@endsection

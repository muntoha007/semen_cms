@extends('layouts.master')
@section('title', 'Daftar Group Kata Kerja')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center table-title">Daftar Group Kata Kerja</h4>
                        @isPermitted('verb-groups.create')
                        <div class="form-group">
                            <a href="{{ route('verb-groups.create') }}" type="button" class="btn btn-outline-info btn-rounded btn-fw btn-sm">
                                <i class="mdi mdi-plus-circle btn-icon-prepend"></i> Tambah
                            </a>
                        </div>
                        @endisPermitted
                        <br>
                        <div class="col-md-12">
                            {!! $dataTable->table(['class'=>'table table-hover table-responsive-lg','id' => 'app'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection

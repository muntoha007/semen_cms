@extends('layouts.master')
@section('title', 'Pattern Lessons Detail List')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center table-title">List Pattern Lesson Details</h4>
                        @isPermitted('lesson-detail-example-add', [request()->route('id'), request()->route('did')])
                        <div class="form-group">
                            <a href="{{ route('lesson-detail-example-add', [request()->route('id'), request()->route('did')]) }}" type="button" class="btn btn-outline-info btn-rounded btn-fw btn-sm">
                                <i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create new
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

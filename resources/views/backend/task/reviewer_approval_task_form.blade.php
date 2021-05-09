@extends('layouts.master')
@section('title', 'Assign Translator')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Approval Reviewer</h4>
                    <br>
                    <form class="forms-sample"
                          action="{{ route('reviewer-approval.update',['id' => $data->id]) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="task_id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'title') }} disabled-readonly"
                                   id="title" name="title" value="{{ old('title',@$data->title) }}"
                                   placeholder="Title" disabled="disabled">
                            {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label>From :</label>
                            <select name="from" class="form-control {{ hasErrorField($errors,'from') }} select2 disabled-readonly" id="from" disabled="disabled">
                                <option value="">Choose</option>
                                @foreach($languages as $k => $language)
                                    @php
                                        $selected = '';
                                        if($language->id == old('from')){
                                            $selected = 'selected';
                                        } else if(@$data->language_from_id == $language->id){
                                            $selected = 'selected';
                                        }

                                    @endphp
                                    <option value="{{ $language->id }}" {{ $selected }}>{{ ucwords($language->name) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('from', '<label class="help-block error-validation" id="msg_from">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label>To :</label>
                            <select name="to" class="form-control {{ hasErrorField($errors,'to') }} select2 disabled-readonly" id="to" disabled="disabled">
                                <option value="">Choose</option>
                                @foreach($languages as $k => $language)
                                    @php
                                        $selected = '';
                                        if($language->id == old('to')){
                                            $selected = 'selected';
                                        } else if(@$data->language_to_id == $language->id){
                                            $selected = 'selected';
                                        }

                                    @endphp
                                    <option value="{{ $language->id }}" {{ $selected }}>{{ ucwords($language->name) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('to', '<label class="help-block error-validation" id="msg_to">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'title') }} disabled-readonly"
                                   id="title" name="title" value="{{ user_info('first_name').' '.user_info('last_name') }}"
                                   placeholder="Title" disabled="disabled">
                            {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <button type="submit" class="btn btn-info btn-fw btn-lg mr-2" name="approve" value="approve">Approve</button>
                        <button type="submit" class="btn btn-danger btn-fw btn-lg" name="reject" value="reject">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

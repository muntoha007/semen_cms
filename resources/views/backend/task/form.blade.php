@extends('layouts.master')
@php
    $title = @$data ? 'Edit' : 'Add New';
@endphp
@section('title', 'Task '.$title)
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }} Task</h4>
                    <br>
                    @php
                        $route = @$data ? route('task.update',['id' => $data->id]) : route('task.store');
                    @endphp
                    <form class="forms-sample"
                          action="{{ $route }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(@$data)
                            <input type="hidden" name="_method" value="put">
                        @endif

                        @if(@$disabledInput)
                            <input type="hidden" name="client" value="true">
                        @endif
                        <div class="form-group">
                            <label>Project </label>
                            <select name="project_id" class="form-control select2 {{ hasErrorField($errors,'project_id') }}" id="project_id" {{ @$disabledInput ? 'disabled' : '' }}>
                                <option value="">Choose</option>
                                @foreach($clients as $j => $client)
                                    @php
                                        $selected = '';
                                        if($client->project_id == old('project_id')){
                                            $selected = 'selected';
                                        } else if(@$data->project_id == $client->project_id){
                                            $selected = 'selected';
                                        }

                                    @endphp
                                    <option value="{{ $client->project_id }}" {{ $selected }}>{{ ucwords($client->name).' - '.ucwords($client->project_name)}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('role', '<label class="help-block error-validation" id="msg_role">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'title') }}"
                                   id="title" name="title" value="{{ old('title',@$data->title) }}"
                                   placeholder="Title" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('title', '<label class="help-block error-validation">:message</label>') !!}
                        </div>
                        <div class="form-group">
                            <label>From :</label>
                            <select name="from" class="form-control {{ hasErrorField($errors,'from') }} select2" id="from" {{@$disabledInput ? 'disabled' : ''}}>
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
                            <select name="to" class="form-control {{ hasErrorField($errors,'to') }} select2" id="to" {{@$disabledInput ? 'disabled' : ''}}>
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
                            <label for="title">Default Price</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'default_price') }}"
                                   id="default_price" name="default_price" value="{{ old('default_price',@$data->default_price ?? 1000) }}"
                                   placeholder="1000" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('default_price', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-check form-check-flat form-check-primary">
                            <input type="hidden" name="using_fuzzy_match" value="false">
                            <label class="form-check-label">
                                @php
                                    $checked = '';
                                    if(old('using_fuzzy_match') == 'on' && @$data->using_fuzzy_match == true){
                                        $checked = 'checked';
                                    }else if(old('using_fuzzy_match') == 'on' && @$data->using_fuzzy_match == false){
                                        $checked = 'checked';
                                    } else if(@$data->using_fuzzy_match == true){
                                        $checked = 'checked';
                                    }
                                @endphp
                                <input type="checkbox" id="using_fuzzy_match" name="using_fuzzy_match" {{ $checked }} class="form-check-input" {{@$disabledInput ? 'disabled' : ''}}> Using Fuzzy Match
                                <i class="input-helper"></i>
                            </label>
                        </div>

                        <br>

                        <div class="form-group fuzzy-match-percentage hidden">
                            <label for="title">Match 1% - 20%</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'fuzzy_1') }}"
                                   id="fuzzy_1" name="fuzzy_1" value="{{ old('fuzzy_1',@$settingFuzzy['1_20'] ?? 900) }}"
                                   placeholder="900" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('fuzzy_1', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group fuzzy-match-percentage hidden">
                            <label for="title">Match 21% - 40%</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'fuzzy_2') }}"
                                   id="fuzzy_2" name="fuzzy_2" value="{{ old('fuzzy_2',@$settingFuzzy['21_40'] ?? 800) }}"
                                   placeholder="800" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('fuzzy_2', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group fuzzy-match-percentage hidden">
                            <label for="title">Match 41% - 60%</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'fuzzy_3') }}"
                                   id="fuzzy_3" name="fuzzy_3" value="{{ old('fuzzy_3',@$settingFuzzy['41_60'] ?? 700) }}"
                                   placeholder="700" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('fuzzy_3', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group fuzzy-match-percentage hidden">
                            <label for="title">Match 61% - 80%</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'fuzzy_4') }}"
                                   id="fuzzy_4" name="fuzzy_4" value="{{ old('fuzzy_4',@$settingFuzzy['61_80'] ?? 600) }}"
                                   placeholder="600" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('fuzzy_4', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group fuzzy-match-percentage hidden">
                            <label for="title">Match 81% - 100%</label>
                            <input type="text" class="form-control {{ hasErrorField($errors,'fuzzy_5') }}"
                                   id="fuzzy_5" name="fuzzy_5" value="{{ old('fuzzy_5',@$settingFuzzy['81_100'] ?? 500) }}"
                                   placeholder="500" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('fuzzy_5', '<label class="help-block error-validation">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            @php
                                $date = null;
                                if(@$data->deadline){
                                    $date = create_date_from_format(@$data->deadline,'Y-m-d H:i:s')->format('d-m-Y H:i');
                                }
                            @endphp
                            <label for="name">Deadline</label>
                            <input type="text" name="deadline" class="form-control {{ hasErrorField($errors,'deadline') }} datetimepicker" id="deadline" autocomplete="off"
                                   value="{{ old('deadline',$date) }}" placeholder="Enter Date" {{@$disabledInput ? 'disabled' : ''}}>
                            {!! $errors->first('deadline', '<label class="help-block error-validation" id="msg_deadline">:message</label>') !!}
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control summernote" id="description" name="description" rows="12" cols="2" {{@$disabledInput ? 'disabled' : ''}}>{{ old('description',@$data->description) }}</textarea>
                            {!! $errors->first('description', '<label class="help-block error-validation">:message</label>') !!}
                        </div>



                        {{--<div class="form-group">--}}
                            {{--<label>File upload</label>--}}
                            {{--<input type="file" name="attachment" class="file-upload-default">--}}
                            {{--<div class="input-group col-xs-12">--}}
                                {{--<input type="text" class="form-control {{ hasErrorField($errors,'attachment') }} file-upload-info" disabled placeholder="Upload Attachment">--}}
                                {{--<span class="input-group-append">--}}
                                    {{--<button class="file-upload-browse btn btn-outline-info btn-icon-text" type="button">Upload</button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                            {{--{!! $errors->first('attachment', '<label class="help-block error-validation">:message</label>') !!}--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <label for="exampleInputFile">File Attachment</label>
                                <input type="file" class="form-control {{ hasErrorField($errors,'attachment') }} dropify" data-errors-position="outside" name="attachment" data-default-file="{{ @get_file(@$data->attachment) }}"
                                       data-height="200" data-max-file-size="2M" data-allowed-file-extensions="csv xlf xliff">
                            </div>
                            {!! $errors->first('attachment', '<label class="help-block error-validation">:message</label>') !!}
                        </div>
                        @if(!isRoleIn('client') || @!$data->attachment)
                            <button type="submit" class="btn btn-info btn-fw btn-lg mr-2">Submit</button>
                        @endif
                        <a href="{{ route('task.index') }}" class="btn btn-secondary btn-fw btn-lg">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#using_fuzzy_match').click(function () {
            let selectedValue = $(this).prop('checked');
            hideShowFuzzyMatchPrecentage(selectedValue)
            console.log($(this).prop('checked'));
        });

        let defaultloaded = $('#using_fuzzy_match').prop('checked');
        hideShowFuzzyMatchPrecentage(defaultloaded);

        function hideShowFuzzyMatchPrecentage(selectedValue){
            if(selectedValue == true){
                $('.fuzzy-match-percentage').removeClass('hidden');
            }else{
                $('.fuzzy-match-percentage').addClass('hidden');
            }
        }

    </script>
@endsection

@extends('layouts.back')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Table Navigation</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Parent</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Permission Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($navigations as $navigation)
                                <tr>
                                    <td><strong>{{ $navigation->parent->name }}</strong></td>
                                    <td>{{ $navigation->name }}</td>
                                    <td>{{ $navigation->url ?? "It's a parent" }}</td>
                                    <td>{{ $navigation->permission_name }}</td>
                                    <td><a href="{{ route('navigation.edit', $navigation) }}">Edit or Remove</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

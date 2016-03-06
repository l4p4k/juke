@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome <b>{{$data->name}}!</div>

                <div class="panel-body">
                    <p><b>Admin rank: </b> @if($data->admin)True @else False @endif</p>
                    <p><b>User ID: </b> {{$data->id}}</p>
                    <p><b>Email address: </b> {{$data->email}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

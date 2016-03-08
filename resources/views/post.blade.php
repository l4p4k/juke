@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Post Details</div>

                <div class="panel-body">
                    @if($data!=NULL)
                        <h1>{{$data->title}}</h1>
                        <p>{{$data->comment}}</p>
                        <a href=/profile/{{$data->user_id}}><b>{{$data->name}}</a>
                    @else
                        <h1> Error 9001 - IT'S OVAR 9000!!! </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

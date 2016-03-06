@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">@if($data->admin)<i class="fa fa-check"></i> @else  @endif <b>{{$data->name}}</b>'s profile</div>

                <div class="panel-body">
                    
                    <p><b>Contact email: </b> <a href="mailto:{{$data->email}}">{{$data->email}} </a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

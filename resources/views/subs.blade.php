@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Your subscribers</div>

                <div class="panel-body">
                    @if($data[0] != null)
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Post Title</th> 
                                    <th class="text-right">Subscriber</th>
                                    <th>Complete job<th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data[0] as $sub)
                                        <tr> 
                                            <td>
                                                <a href=/post/{{$sub->post_id}}>{{$sub->title}}</a>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$sub->user_id}}>{{$sub->email}}</a>
                                            </td>
                                            @if($sub->stage != 1)
                                            <td>
                                                <a href=/subComplete/{{$sub->post_id}} class='btn btn-danger'> Complete</a>
                                            </td> 
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        None of your posts have subscribers
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Posts you have subscribed to</div>

                <div class="panel-body">
                    @if($data[1] != null)
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th >Post Title</th> 
                                    <th class="text-right">Post Owner</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data[1] as $sub)
                                        <tr> 
                                            <td>
                                                <a href=/post/{{$sub->post_id}}>{{$sub->title}}</a>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$sub->user_id}}>{{$sub->email}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        You have not subscribed to any post yet
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

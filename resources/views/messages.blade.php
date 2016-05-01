@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Messages for me</div>

                <div class="panel-body">
                    @if($data[0] != null)
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Subject</th> 
                                    <th>Message</th> 
                                    <th>Post Title</th> 
                                    <th class="text-right">Posted by</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data[0] as $message_for_me)
                                        <tr> 
                                            <td><b>{{$message_for_me->subject}}<b></td>
                                            <td>{{$message_for_me->msg}}</td>
                                            <td>
                                                <a href=/post/{{$message_for_me->post_id}}>{{$message_for_me->title}}</a>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$message_for_me->user_id}}>{{$message_for_me->email}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    You have no messages for you
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Messages by me</div>

                <div class="panel-body">
                    @if($data[1] != null)
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Subject</th> 
                                    <th>Message</th> 
                                    <th >Post Title</th> 
                                    <th class="text-right">Post Owner</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data[1] as $message_by_me)
                                        <tr> 
                                            <td><b>{{$message_by_me->subject}}<b></td>
                                            <td>{{$message_by_me->msg}}</td>
                                            <td>
                                                <a href=/post/{{$message_by_me->post_id}}>{{$message_by_me->title}}</a>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$message_by_me->user_id}}>{{$message_by_me->email}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    You have sent no messages
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

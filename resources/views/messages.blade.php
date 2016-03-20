@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My messages</div>

                <div class="panel-body">
                    @if($data != null)
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
                                    @foreach($data as $post)
                                        <tr> 
                                            <td><b>{{$post->subject}}<b></td>
                                            <td>{{$post->msg}}</td>
                                            <td class="text-right">
                                                <a href=/post/{{$post->post_id}}>{{$post->title}}</a>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$post->user_id}}>{{$post->fname}} {{$post->sname}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    You have no messages
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

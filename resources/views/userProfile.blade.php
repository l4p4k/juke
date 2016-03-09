@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">@if($data[0]->admin)Admin @else  @endif <b>{{$data[0]->fname}} {{$data[0]->sname}}</b>'s profile</div>

                <div class="panel-body">
                    <p><b>Contact email: </b> <a href="mailto:{{$data[0]->email}}">{{$data[0]->email}} </a> </p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Posts by <b>{{$data[0]->fname}} {{$data[0]->sname}}</div>
                <div class="panel-body">
                    @if($data[1] != null)
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                <th class="col-md-6">Title</th> 
                                <th class="col-md-3 text-right">Comment</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data[1] as $key => $post)
                                    <tr> 
                                        <td>
                                            <b><a href=/post/{{$post->id}}>{{$post->title}}</a><b>
                                        </td>
                                        <td class="text-right">
                                            @if(substr($post->comment,0,strpos($post->comment, ' ', 40)))
                                                {{substr($post->comment,0,strpos($post->comment, ' ', 40))}}
                                            @else

                                            @endif
                                            ...
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    This user has no posts
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

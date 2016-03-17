@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    @if($data[1] != null)
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                <th class="col-md-6">Title</th> 
                                <th class="col-md-3 text-right">Posted by</th>
                                @if (!Auth::guest())
                                @if(Auth::user()->admin)
                                <th class="col-md-1">Delete</th>
                                @endif 
                                @endif 
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data as $post)
                                    <tr> 
                                        <td>
                                            <a href=/post/{{$post->id}}>
                                                @if($post->post_type)
                                                <b>[Offer] </b>
                                                @else
                                                <b>[Request] </b>
                                                @endif
                                                {{$post->title}}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <a href=/profile/{{$post->user_id}}>{{$post->fname}} {{$post->sname}}</a>
                                        </td>
                                        @if (!Auth::guest())
                                        @if(Auth::user()->admin)
                                        <td>
                                            <a href=/delete/{{$post->id}} class='btn btn-danger'>
                                            <i class="fa fa-trash-o fa-lg"></i> Delete</a>
                                        </td> 
                                        @endif 
                                        @endif 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    There are no posts
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

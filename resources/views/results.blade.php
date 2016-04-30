@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    @if($data != null)
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th class="col-md-6">Title</th> 
                                    <th class="col-md-3 text-right">Posted by</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data as $post)
                                        <tr> 
                                            <td>
                                                <b><a href=/post/{{$post->id}}>{{$post->title}}</a><b>
                                            </td>
                                            <td class="text-right">
                                                <a href=/profile/{{$post->user_id}}>{{$post->fname}} {{$post->sname}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- make links to go to other pages -->
                            {{ $data->appends(Request::except('page'))->render() }}
                        </div>
                    @else
                    No posts were found with that keyword
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

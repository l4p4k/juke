@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">@if($data[0]->admin)Admin @else  @endif <b>{{$data[0]->fname}} {{$data[0]->sname}}</b>'s profile</div>

                <div class="panel-body">
                    <p><b>Contact email: </b> <a href="mailto:{{$data[0]->email}}">{{$data[0]->email}} </a> </p>
                    <p><b>Postcode: </b> @if($data[0]->postcode != null) {{$data[0]->postcode}} @else --- @endif</p>
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
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data[1] as $key => $post)
                                    <tr> 
                                        <td>
                                            <b><a href=/post/{{$post->id}}>{{$post->title}}</a><b>
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

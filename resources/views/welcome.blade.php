@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Title</th> 
                                <th>Comment</th> 
                                <th>Posted by</th>
                                @if(Auth::user()->admin)
                                <th>Delete</th>
                                @endif 
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data as $key => $post)
                                    <tr> 
                                        <td>
                                            <a href=/post/{{$post->id}}>{{$post->title}}</a>
                                        </td>
                                        <td>
                                            {{wordwrap($post->comment,30,"\n")}}
                                        </td> 
                                        <td>
                                        <br>{{$post->name}}
                                        </td> 
                                        @if(Auth::user()->admin)
                                        <td>
                                            <button type='button' class='btn'>Delete</button>
                                        </td> 
                                        @endif 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

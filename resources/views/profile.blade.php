@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome <b>{{$data[0]->name}}!</div>

                <div class="panel-body">
                    <p><b>Admin rank: </b> @if($data[0]->admin)True @else False @endif</p>
                    <p><b>User ID: </b> {{$data[0]->id}}</p>
                    <p><b>Email address: </b> {{$data[0]->email}}</p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Your posts</div>
                <div class="panel-body">
                    @if($data[1] != null)
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                <th class="col-md-6">Title</th> 
                                @if (!Auth::guest())
                                @if(Auth::user()->admin)
                                <th class="col-md-1">Delete</th>
                                @endif 
                                @endif 
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach($data[1] as $key => $post)
                                    <tr> 
                                        <td>
                                            <b><a href=/post/{{$post->id}}>{{$post->title}}</a><b>
                                        </td>
                                        @if (!Auth::guest())
                                        @if(Auth::user()->admin)
                                        <td>
                                            <button type='button' class='btn-danger'>Delete</button>
                                        </td> 
                                        @endif 
                                        @endif 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    You have no posts
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

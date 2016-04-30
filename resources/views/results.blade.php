@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Results for {{$title}}</div>

                <div class="panel-body">
                    @if($data != null)
                        @if($filter != null)
                            <form class="form-inline" role="form" method="GET" action="{{ route('extra_search') }}">

                                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">

                                    <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                                        <label class="control-label">Search</label>

                                        <input type="text" class="form-control" name="search" value="{{ old('search') }}">

                                        @if ($errors->has('search'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('search') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Job/Service type</label>

                                    <select name="job_type">
                                        <option value="">All</option>
                                        <option value="Transport">Transport</option>
                                        <option value="House Maintenence">House Maintenence</option>
                                        <option value="Tech Maintenence">Tech Maintenence</option>
                                        <option value="Childcare">Childcare</option>
                                        <option value="Food & Drink">Food & Drink</option>
                                        <option value="Health & Beauty">Health & Beauty</option>
                                        <option value="Tuition">Tuition</option>
                                        <option value="Decoration">Decoration</option>
                                        <option value="Guides">Guides</option>
                                        <option value="Housing">Housing</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Post type</label>

                                    <select name="post_type">
                                        <option value="">All</option>
                                        <option value="1">Offer</option>
                                        <option value="0">Request</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>Search 
                                    </button>
                                </div>
                            </form>
                        @endif
                        <div class="table-responsive">
                            <table class="table" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Title</th> 
                                    <th>Type</th>
                                    <th class="text-right">Posted by</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach($data as $post)
                                        <tr> 
                                            <td>
                                                <b><a href="/post/{{$post->post_id}}">
                                                @if($post->post_type)
                                                <b>[Offer] </b>
                                                @else
                                                <b>[Request] </b>
                                                @endif
                                                {{$post->title}}</a><b>
                                            </td>
                                            <td><a href="/showPostJobTypes/{{$post->job_type}}">{{$post->job_type}}</a></td>
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

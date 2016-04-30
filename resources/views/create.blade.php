@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create a New Post</div>

                <div class="panel-body">

                    @if($data == "")
                        <!-- do nothing -->
                    @elseif($data == 'true')
                        <div class='alert alert-success'> <strong>Success!</strong> You created a post </div>
                    @endif
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('post.create') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Comment</label>

                            <div class="col-md-6">
                                <textarea type="text" rows="5" class="form-control" name="comment" value="{{ old('comment') }}"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Job/Service type</label>
                            <div class="col-md-1">
                                <select name="job_type">
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
                        </div>

                        <label class="col-md-4 control-label">Is this post a request or offering your skills?</label>
                        <div class="col-md-6">
                            <input type="radio" name="post_type" value="0" checked> Service request<br>
                            <input type="radio" name="post_type" value="1"> Skill offer<br>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-comment"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($data!=NULL)
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($data->post_type)
                    <b>Offer </b>
                    @else
                    <b>Request </b>
                    @endif
                    Post Details
                </div>

                    <div class="panel-body">
                        <h1>{{$data->title}}</h1>
                        <p>{{$data->comment}}</p>
                        <a href=/profile/{{$data->user_id}}>{{$data->fname}} {{$data->sname}}</a>
                    </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Message user
                </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('messages.create') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Subject</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">

                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                                <label class="col-md-2 control-label">Message</label>
                                <div class="col-md-4">
                                    <textarea type="text" rows="5" class="form-control" name="msg" value="{{ old('msg') }}"></textarea>
                                    @if ($errors->has('msg'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('msg') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="post_id" value="{{$data->post_id}}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-0">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-comment"></i> Send message</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    Error
                </div>
                <div class="panel-body">
                    Error in post details
                </div>
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Share</div>

                <div class="panel-body">
                    <!-- Twitter -->
                    <a href="http://twitter.com/home?status=" title="Share on Twitter" target="_blank" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                     <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=" title="Share on Facebook" target="_blank" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                    <!-- Google+ -->
                    <a href="https://plus.google.com/share?url=" title="Share on Google+" target="_blank" class="btn btn-googleplus"><i class="fa fa-google-plus"></i> Google+</a>
                    <!-- LinkedIn --> 
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=" title="Share on LinkedIn" target="_blank" class="btn btn-linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

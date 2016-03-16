@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Post Details</div>

                <div class="panel-body">
                    @if($data!=NULL)
                        <h1>{{$data->title}}</h1>
                        <p>{{$data->comment}}</p>
                        <a href=/profile/{{$data->user_id}}>{{$data->fname}} {{$data->sname}}</a>
                    @else
                        <h1> Error 9001 - IT'S OVAR 9000!!! </h1>
                    @endif
                </div>
            </div>

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

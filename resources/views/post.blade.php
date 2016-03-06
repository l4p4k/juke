@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Post Details</div>

                <div class="panel-body">
                    <?php
                    if($data!=NULL){
                        echo "<h1>".$data->title."</h1>";
                        echo "<p>".$data->comment."</p>";
                        echo "<p><b> -- ".$data->name." --</p>";
                    }else{
                        echo "<h1> Error 9001 - IT'S OVAR 9000!!! </h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

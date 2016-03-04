@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <table border="1" style="width:100%">
                        <tr>
                        <th>Title</th>
                        <th>Comment</th> 
                        <th>Posted by</th> 
                        </tr>
                        <?php
                        //$query = App\Post::select('id','name');
                        $query = App\Post::get();
                            foreach($query as $post) {
                                echo "<tr> <td>";
                                echo $post->title;
                                echo "</td><td>";
                                echo $post->comment;
                                echo"</td> <td>";
                                echo $post->user_id;
                                echo"</td> </tr>";
                            }
                        ?>
                    </table>
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

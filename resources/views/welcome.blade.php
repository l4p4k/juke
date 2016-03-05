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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($data as $key => $post) {
                                        echo "<tr> <td>";
                                        echo $post->title;
                                        echo "</td> <td>";
                                        $str = $post->comment;
                                        echo wordwrap($str,50,"<br>\n");
                                        echo"</td> <td><br>";
                                        echo $post->name;
                                        echo "</td> </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                        <?php
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

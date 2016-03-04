@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <table style="width:100%">
                        <tr>
                        <th>Title</th>
                        <th>Comment</th> 
                        <th>Posted by</th> 
                        </tr>
                        <?php
                            foreach($data as $key => $post) {
                                echo "<tr> <td>";
                                echo $post->title;
                                echo "</td><td>";
                                echo $post->comment;
                                echo"</td> <td>";
                                echo $post->name;
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

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
                        <th>ID</th>
                        <th>Name</th> 
                        </tr>
                        <?php
                        $query = App\Post::select('id','name');
                            foreach($query as $user) {
                                echo "<tr> <td>";
                                echo $user->id;
                                echo "</td><td>";
                                echo $user["name"];
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

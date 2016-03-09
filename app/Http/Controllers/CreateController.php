<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;

class CreateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        $message = "";
        return view('create')->withdata($message);
    }

    public function postCreate(Request $request)
    {
        //needs validation
        $user_id = Auth::user()->id;
        $title = $request['title'];
        $comment = $request['comment'];

        $post = new Post();
        $insert = $post->createPost($user_id, $title, $comment);
        
        if($insert == 1){
            $message = "<div class='alert alert-success'> <strong>Success!</strong> You created a post </div>";
        }else{
            $message = "<div class='alert alert-danger'> <strong>Error!</strong> Your post was not created </div>";
        }
        return view('create')->withdata("$message");
    }
}

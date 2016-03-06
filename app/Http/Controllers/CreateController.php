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
        $userID = 
        $user_id = Auth::user()->id;
        $title = $request['title'];
        $comment = $request['comment'];

        DB::table('post')->insert([
            ['id' => "", 'user_id' => $user_id, 'title' => $title, 'comment' => $comment]
        ]);
        $message = "<div class='alert alert-success'> <strong>Success!</strong> You created a post </div>";
        //return redirect()->route('home');
        return view('create')->withdata("$message");
    }
}

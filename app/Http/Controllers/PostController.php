<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as Post;
use App\Http\Requests;
use Auth;
//use App\Http\Controllers\Controller;

class PostController extends Controller
{
	    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','viewPost']]);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   
        $post = new Post();
        $data = $post->showPosts();
        // foreach($data as $key => $post){
        //     echo $post->title."<br>";
        // }
        return view('welcome')->withdata($data);
    }

    public function viewPost($id)
    {
        $post = new Post();
        $data = $post->showPost($id);
        return view('post')->withdata($data);
    }

}

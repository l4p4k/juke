<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as Post;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use URL;
//use App\Http\Controllers\Controller;

class PostController extends Controller
{
	    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
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
        return view('welcome')->withdata($data);
    }

    public function viewPost($id){
        $post = new Post();
        $data = $post->showPost($id);
        return view('post')->withdata($data);
    }

    public function deletePost($id){
        $post = new Post();
        $postDetails = $post->showPost($id);
        if($postDetails != null){
            if($postDetails->user_id == Auth::user()->id){
                $post = new Post();
                $post->deletePost($id);
            }else{
                $data = "This isn't your post to delete";
                return view('error')->withdata($data);
            }
        }else{
            return redirect()->route('deleteError');
        }
        //takes you to the previous page
        return Redirect::to(URL::previous());
    }

    public function deleteError(){
        $data = "No post to delete";
        return view('error')->withdata($data);
    }

}

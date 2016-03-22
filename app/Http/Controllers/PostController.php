<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Post as Post;
use App\Subscription as Sub;
use App\Http\Requests;

use URL;
use Validator;
use Auth;
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

    public function rate(Request $request){
        $post = new Post();
        $sub = new Sub();

        $rating = $request->input('rating');
        $post_id = $request->input('post_id');
        $user_id = Auth::user()->id;

        if($sub->is_rated($post_id, $user_id) == null){
            $post->rate($post_id, $user_id, $rating);
        }else{
            return "you already voted";
        }


        //takes you to the previous page
        return Redirect::to(URL::previous());
    }

    public function simple_search(Request $request){
        $post = new Post();
        // Get data
        $input_data = array(
            'search'     => $request->input('search')
        );
        // Build the validation rules.
        $rules = array(
            'search'     => 'string|min:3'
        );

        // Create a new validator instance.
        $validator = Validator::make($input_data, $rules);

        if($input_data['search'] == ""){
            $error = array('search' => "The search key must not be empty");
            return Redirect::to(URL::previous())->withErrors($error)->withInput();
        }

         if (($validator->fails())) {
            return Redirect::to(URL::previous())->withErrors($validator)->withInput();
        }
        // If the data passes validation
        if ($validator->passes()) {
            $data[0] = $post->search('title', $input_data['search']);
            $data[1] = $post->search('comment', $input_data['search']);
            // var_dump($data);
            return view('results')->withdata($data);
        }
    }

    public function viewPost($id){
        $post = new Post();
        $data = $post->showPost($id);
        $get_rating = $post->getRating($id);
        if($get_rating != null){
            $rating = 0;
            $i = 0;
            foreach ($get_rating as $value) {
                $rating += $value->rating;
                $i++;
            }
            $rating = $rating/$i;
        }else{
            $rating = 0;
        }
        return view('post')->withdata($data)->with('rating', $rating);
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

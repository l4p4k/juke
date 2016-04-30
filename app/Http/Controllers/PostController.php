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
        $this->middleware('auth', ['except' => ['index','viewPost', 'simple_search']]);
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



    public function simple_search(Request $request){
        $post = new Post();
        // Get data
        $input_data = array(
            'search'     => $request->input('search')
        );
        // Build the validation rules.
        $rules = array(
            'search'     => 'string|min:2'
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
            $data = $post->search('title', $input_data['search']);
            if(count($data) == 0)
            $data = $post->search('comment', $input_data['search']);
            // var_dump($data);
            return view('results')->withdata($data);
        }
    }

    public function viewPost($id){
        $post = new Post();
        $sub = new Sub();

        $post_id = $id;
        $data = $post->showPost($id);
        $get_rating = $sub->getRating($id);
        if (!Auth::guest()){
            $user_id = Auth::user()->id;

            if($sub->is_subbed($post_id, $user_id) == null){
                $var['is_subbed'] = false;
            }else{
                $var['is_subbed'] = true;
            }

            if($sub->is_not_rated($post_id, $user_id) == null){
                $var['is_rated'] = true;
            }else{
                $var['is_rated'] = false;
            }
        }else{
            $var['is_subbed'] = false;
            $var['is_rated'] = false;
        }

        //calculate rating
        if($get_rating != null){
            $rating = 0;
            $i = 0;
            foreach ($get_rating as $value) {
                $rating += $value->rating;
                $i++;
            }
            $var['rating'] = $rating/$i;
        }else{
            $var['rating'] = 0;
        }


        return view('post')
        ->withdata($data)
        ->with('var', $var);
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

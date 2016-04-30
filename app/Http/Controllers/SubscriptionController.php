<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Subscription as Sub;
use App\Post as Post;

use App\Http\Requests;

use URL;
use Validator;
use Auth;

class SubscriptionController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function rate(Request $request){
        $sub = new Sub();

        $rating = $request->input('rating');
        $post_id = $request->input('post_id');
        $user_id = Auth::user()->id;

        if($sub->is_not_rated($post_id, $user_id) == null){
            $data = "You've already voted for this post!";
            return view('error')->withdata($data);
        }else{
            $sub->rate($post_id, $user_id, $rating);
        }

        //takes you to the previous page
        return Redirect::to(URL::previous());
    }

    public function sub($post_id){
        $sub = new Sub();
        $user_id = Auth::user()->id;

        if($sub->is_subbed($post_id, $user_id) != null){
            $data = "You're already subscribed to this post!";
            return view('error')->withdata($data);
        }else{

            $post = new Post();
            $data = $post->showPost($post_id);
            if($data->user_id != $user_id){
                $sub->subscribe($user_id, $post_id);
            }
            
            //takes you to the previous page
            return Redirect::to(URL::previous());
        }
    }

    public function subs(){
        $sub = new Sub();
        $user_id = Auth::user()->id;
        $data[0] = $sub->showSubsToMe($user_id);
        $data[1] = $sub->showSubsByMe($user_id);
        return view('subs')->withdata($data);
    }

    public function subComplete($post_id){
        $sub = new Sub();
        $user_id = Auth::user()->id;
        
        if($sub->subBelongs($user_id, $post_id)){
            $sub->subComplete($post_id);
            return Redirect::to('subs');
        }else{
            return Redirect::to('error');
        }
    }
}

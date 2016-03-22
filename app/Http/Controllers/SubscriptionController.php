<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Subscription as Sub;

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
            return "you already voted";
        }else{
            $sub->rate($post_id, $user_id, $rating);
        }

        //takes you to the previous page
        return Redirect::to(URL::previous());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use DB;

use App\Post as Post;

class CreateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }


    public function create(){
        $data = "";
        return view('create')->withdata($data);
    }

    public function postCreate(Request $request){
        //get authorised user's ID
        $user_id = Auth::user()->id;

        // Get data from form post
        $formData = array(
            'title' => $request->input('title'),
            'comment' => $request->input('comment'),
            'post_type' => $request->input('post_type'),
            'job_type' => $request->input('job_type'),
        );

        // Build the validation rules.
        $rules = array(
            'title'     => 'required|string|max:60|min:10',
            'comment'     => 'required|string|max:255|min:20',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        // If data is not valid
        if ($validator->fails()) {
            $data = 'false';
            return redirect()->route('create')->withErrors($validator)->withInput();
        }

        // If the data passes validation
        if ($validator->passes()) {
            $post = new Post();
            $insert = $post->createPost($user_id, $formData['post_type'], $formData['title'], $formData['comment'], $formData['job_type']);
            $data = 'true';
            return view('create')->withdata("$data");
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Validator;
use Session;

use App\Message as Message;

class MessageController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   
        return view('messages');//->withdata($data);
    }

    public function create(Request $request){
        //get authorised user's ID
        $user_id = Auth::user()->id;

        $formData = array(
            'subject' => $request->input('subject'),
            'msg' => $request->input('msg'),
            'post_id' => $request->input('post_id'),
        );

        // Build the validation rules.
        $rules = array(
            'subject' => 'required|string|max:50|min:10',
            'msg' => 'required|string|max:50|min:10',
            'post_id' => 'required',
        );

        // Create a new validator instance.
        $validator = Validator::make($formData, $rules);

        // If data is not valid
        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $user_id = Auth::user()->id;
        // If the data passes validation
        if ($validator->passes()) {
            $msg = new Message();
            $msg->createMessage($user_id, $formData['post_id'], $formData['subject'], $formData['msg']);
            $data = 'true';
            //Session::flash('messageStatus', $messageStatus);
            return redirect()->route('profile');
        }
    }
}

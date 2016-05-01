<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Validator;
use Session;

use App\User as User;
use App\Post as Post;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'userProfile']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $loggedUser = new User();
        $yourUserID = Auth::user()->id;
        $data[0] = $loggedUser->getLoggedUser($yourUserID);

        $userPosts = new Post();
        $data[1] = $userPosts->getUserPosts($yourUserID);
        return view('profile')->withdata($data);
    }

    public function userProfile($id)
    {
        $userProfile = new User();
        $data[0] = $userProfile->getLoggedUser($id);
        if($data[0] ==null){
            return redirect()->route('error');
        }

        $userPosts = new Post();
        $data[1] = $userPosts->getUserPosts($id);

        return view('userProfile')->withdata($data);
    }

    public function editProfile(Request $request){
          // Get data from form post
        $data = array(
            "phone" => $request->input('phone'),
            "postcode" => $request->input('postcode'),
            "fname" => $request->input('fname'),
            "sname" => $request->input('sname'),
        );

        // Build the validation rules.
        $rules = array(
            'phone'     => 'string|size:11',
            'postcode'  => array('Regex:/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/'),
            'fname' => 'max:50',
            'sname' => 'max:50',
        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules);

        // If data is not valid
        if ($validator->fails()) {
            $messageStatus = "profile update error";
            Session::flash('messageStatus', $messageStatus);
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $user_id = Auth::user()->id;
        // If the data passes validation
        if ($validator->passes()) {
            $thisUser = new User();
            $userInfo = $thisUser::where('users.id', '=', $user_id)->first();

            if($data['phone'] != $userInfo->phone){
                $userInfo->phone = $data['phone'];   
            }

            if($data['postcode'] != $userInfo->postcode){ 
                $userInfo->postcode = $data['postcode'];          
            }

            if($data['fname'] != $userInfo->fname){
                $userInfo->fname = $data['fname'];   
            }

            if($data['sname'] != $userInfo->sname){ 
                $userInfo->sname = $data['sname'];          
            }

            $userInfo->save();

            $loggedUser = new User();
            $yourUserID = $user_id;
            $data[0] = $loggedUser->getLoggedUser($yourUserID);

            $userPosts = new Post();
            $data[1] = $userPosts->getUserPosts($yourUserID);

            $messageStatus = "success";
            Session::flash('messageStatus', $messageStatus);
            return Redirect::route('profile');
        }
    }
}

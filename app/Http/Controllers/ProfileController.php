<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User as User;
use App\Post as Post;
use Auth;

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
        // var_dump($data);
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
        $user_id = Auth::user()->id;
        $phone = $request['phone'];
        $postcode = $request['postcode'];

        $thisUser = new User();
        $userInfo = $thisUser::where('users.id', '=', $user_id)->first();

        $userInfo->phone = $phone;
        $userInfo->postcode = $postcode;
        $userInfo->save();
        echo "I am changing phone to ".$phone." and postcode to ".$postcode."<br";
    }
}

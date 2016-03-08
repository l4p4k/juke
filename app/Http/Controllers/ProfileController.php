<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
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

        $userPosts = new Post();
        $data[1] = $userPosts->getUserPosts($id);

        return view('userProfile')->withdata($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User as User;
use App\Post as Post;
use Auth;
use Validator;

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
        // $this->validate($request, [
        //     'phone' => 'string|size:11',
        //     'postcode' => 'string|array('Regex:/^[A-Za-z0-9\-! ,\'\"\/@\.:\(\)]+$/')'
        // ]);

          // Fetch all request data.
        $data = array(
            "phone" => $request->input('phone'),
            "postcode" => $request->input('postcode'),
        );

        // Build the validation constraint set.
        $rules = array(
            'phone'     => 'string|size:11',
            'postcode'  => array('Regex:/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/'),
        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules);

        // $user_id = Auth::user()->id;
        // $phone = $request['phone'];
        // $postcode = $request['postcode'];

        if ($validator->passes()) {
        // Normally we would do something with the data.
            var_dump($data);
            echo " Data saved!!!";
            return;
        }

        if ($validator->fails()) {
            var_dump($data);
            echo " Data was not saved.";
            return;
        }

        // $thisUser = new User();
        // $userInfo = $thisUser::where('users.id', '=', $user_id)->first();

        // $userInfo->phone = $phone;
        // $userInfo->postcode = $postcode;
        // $userInfo->save();\  
        return redirect()->route('profile');
    }
}

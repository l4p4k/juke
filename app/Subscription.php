<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{    
	protected $table = "subscription";

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function Post(){
        return $this->belongsTo('App\Post');
    }

    public function rate($post_id, $user_id, $rate){
        DB::table('subscription')
            ->where('subscription.post_id', '=', $post_id)
            ->where('subscription.user_id', '=', $user_id)
            ->update(array('rating' => $rate));

        return;
    }

    public function showSubsToMe($user_id){
        $query = DB::table('subscription')
            ->select('subscription.*', 'users.fname','users.sname', 'post.title', 'post.user_id AS postowner')
            ->join('post', 'post.post_id', '=', 'subscription.post_id')
            ->join('users', 'users.id', '=', 'subscription.user_id')
            ->orderBy('subscription.sub_id', 'DESC')
            ->where('post.user_id', '=', $user_id)
            ->get();
        return $query;
    }

    public function showSubsByMe($user_id){
        $query = DB::table('subscription')
            ->select('subscription.*', 'users.fname','users.sname', 'post.*')
            ->join('post', 'post.post_id', '=', 'subscription.post_id')
            ->join('users', 'users.id', '=', 'post.user_id')
            ->orderBy('subscription.sub_id', 'DESC')
            ->where('subscription.user_id', '=', $user_id)
            ->get();
        return $query;
    }

    public function subscribe($user_id, $post_id){
        DB::table('subscription')->insert([
            ['sub_id' => "", 'post_id' => $post_id, 'user_id' => $user_id, 'rating' => "0"]
        ]);
    }

    public function getRating($post_id){
        $query = DB::table('subscription')
            ->select('subscription.*')
            ->where('subscription.post_id', '=', $post_id)
            ->where('subscription.rating', '!=', "0")
            ->get();
        return $query;
    }
    
    public function is_subbed($post_id, $user_id){
        $query = DB::table('subscription')
            ->where('subscription.post_id', '=', $post_id)
            ->where('subscription.user_id', '=', $user_id)
            ->get();
        return $query;
    }

    public function is_not_rated($post_id, $user_id){
        $query = DB::table('subscription')
            ->where('subscription.post_id', '=', $post_id)
            ->where('subscription.user_id', '=', $user_id)
            ->where('subscription.rating', '=', 0)
            ->get();
        return $query;
    }

    public function subBelongs($user_id, $post_id){
        $query = DB::table('subscription')
            ->select('subscription.*', 'users.fname','users.sname', 'post.*')
            ->join('post', 'post.post_id', '=', 'subscription.post_id')
            ->join('users', 'users.id', '=', 'post.user_id')
            ->orderBy('subscription.sub_id', 'DESC')
            ->where('post.user_id', '=', $user_id)
            ->where('subscription.post_id', '=', $post_id)
            ->first();

        if($query != null){
            return true;
        }else{
            return false;
        }
    }

    public function subComplete($post_id){
        $query = DB::table('subscription')
            ->where('subscription.post_id', '=', $post_id)
            ->first();

            if($query->stage==null || $query->stage=="0"){
                DB::table('subscription')
                ->where('subscription.post_id', '=', $post_id)
                ->update(array('stage' => "1"));
            }

        return;
    }
}

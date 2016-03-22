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

    public function getRating($post_id){
        $query = DB::table('subscription')
            ->select('subscription.*')
            ->where('subscription.post_id', '=', $post_id)
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
}

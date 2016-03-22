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

    public function is_rated($post_id, $user_id){
        $query = DB::table('subscription')
            ->where('subscription.post_id', '=', $post_id)
            ->where('subscription.user_id', '=', $user_id)
            ->get();
        return $query;
    }
}

<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Message extends Model{    
	public function user(){
    	return $this->belongsTo('App\User');
    }

    public function createMessage($user_id, $post_id, $subject, $msg){
        $query = DB::table('message')->insert([
            ['id' => "", 'user_id' => $user_id, 'post_id' => $post_id, 'subject' => $subject, 'msg' => $msg]
        ]);

        return $query;
    }
}

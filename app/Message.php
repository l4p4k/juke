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
            ['msg_id' => "", 'msg_user_id' => $user_id, 'post_id' => $post_id, 'subject' => $subject, 'msg' => $msg]
        ]);

        return $query;
    }

    public function showMessagesToMe($id){
    	$query = DB::table('message')
    		->select('message.*', 'users.fname','users.sname','users.email', 'post.*')
			->join('post', 'post.post_id', '=', 'message.post_id')
			->join('users', 'users.id', '=', 'message.msg_user_id')
			->orderBy('message.msg_id', 'DESC')
            ->where('post.user_id', '=', $id)
			->get();
    	return $query;
    }

    public function showMessagesByMe($id){
        $query = DB::table('message')
            ->select('message.*', 'users.fname','users.sname','users.email', 'post.*')
            ->join('post', 'post.post_id', '=', 'message.post_id')
            ->join('users', 'users.id', '=', 'post.user_id')
            ->orderBy('message.msg_id', 'DESC')
            ->where('message.msg_user_id', '=', $id)
            ->get();
        return $query;
    }
}

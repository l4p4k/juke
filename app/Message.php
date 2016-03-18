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
            ['message_user_id' => "", 'user_id' => $user_id, 'post_id' => $post_id, 'subject' => $subject, 'msg' => $msg]
        ]);

        return $query;
    }

    public function showMyMessages($id){
    	$query = DB::table('message')
    		->select('message.*', 'users.fname','users.sname', 'post.*')
			->join('post', 'post.post_id', '=', 'message.post_id')
			->join('users', 'users.user_id', '=', 'message.message_user_id')
			//->orderBy('message.id', 'DESC')
            ->where('post.user_id', '=', $id)
			->get();
    	return $query;
    }
// SELECT m.id, u.fname,m.subject,p.title 
// FROM message m 
// INNER JOIN post p ON p.id = m.post_id 
// INNER JOIN users u ON u.id = m.user_id
}

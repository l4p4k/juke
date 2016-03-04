<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function showPosts(){
    	$query = DB::table('users')
			->join('post', 'users.id', '=', 'post.user_id')
			->select('users.id', 'users.name', 'post.*')
			->orderBy('post.id')
			->get();
    	return $query;
    }
}

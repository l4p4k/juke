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
			->select('users.id', 'users.fname', 'users.sname', 'post.*')
			->orderBy('post.id', 'DESC')
			->get();
    	return $query;
    }

    public function showPost($id){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.id', 'users.fname', 'users.sname', 'post.*')
            ->where('post.id', '=', $id)
            ->first();
        return $query;
    }

    public function getUserPosts($id){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.id', 'users.fname', 'users.sname', 'post.*')
            ->orderBy('post.id', 'DESC')
            ->where('users.id', '=', $id)
            ->get();
        return $query;
    }

    public function createPost($user_id, $post_type, $title, $comment){
        $query = DB::table('post')->insert([
            ['id' => "", 'user_id' => $user_id, 'post_type' => $post_type, 'title' => $title, 'comment' => $comment]
        ]);

        return $query;
    }

    public function deletePost($post_id){
        $query = DB::table('post')->where('id', '=', $post_id)->delete();

        return $query;
    }

    public function search($column, $criteria){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.id', 'users.fname', 'users.sname', 'post.*')
            ->orderBy('post.id', 'DESC')
            ->where('post.'.$column, 'like','%'.$criteria.'%')
            ->get();

        return $query;
    }
}

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

    public function message(){
        return $this->hasMany('App\Message', 'post_id');
    }

    public function subscription(){
        return $this->hasMany('App\Subscription', 'user_id');
    }

    public function showPosts(){
    	$query = DB::table('users')
			->join('post', 'users.id', '=', 'post.user_id')
			->select('users.id', 'users.fname', 'users.sname','users.email', 'post.*')
			->orderBy('post.post_id', 'DESC')
            ->paginate(10);
    	return $query;
    }

    public function showPostJobTypes($jobType){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.fname', 'users.sname','users.email', 'post.*')
            ->orderBy('post.post_id', 'DESC')
            ->where('post.job_type','=',$jobType)
            ->paginate(10);
        return $query;
    }

    public function showPost($id){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.id', 'users.fname', 'users.sname','users.email', 'post.*')
            ->where('post.post_id', '=', $id)
            ->first();
        return $query;
    }

    public function getUserPosts($id){
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.id', 'users.fname', 'users.sname','users.email', 'post.*')
            ->orderBy('post.post_id', 'DESC')
            ->where('users.id', '=', $id)
            ->get();
        return $query;
    }

    public function createPost($user_id, $post_type, $title, $comment, $job_type){
        $query = DB::table('post')->insert([
            ['post_id' => "", 'user_id' => $user_id, 'post_type' => $post_type, 'title' => $title, 'comment' => $comment, 'job_type' => $job_type]
        ]);

        return $query;
    }

    public function deletePost($post_id){
        $query = DB::table('post')->where('post_id', '=', $post_id)->delete();

        return $query;
    }

    public function search($column, $criteria, $job_type, $post_type){
        $num_on_page = 10;
        $query = DB::table('users')
            ->join('post', 'users.id', '=', 'post.user_id')
            ->select('users.fname', 'users.sname','users.email', 'post.*')
            ->orderBy('post.post_id', 'DESC')
            ->where('post.'.$column, 'like','%'.$criteria.'%');
            if($job_type!="")
                $query->where('post.job_type','=', $job_type);
            if($post_type!="")
                $query->where('post.post_type','=', $post_type);
            $rows = $query->paginate($num_on_page);

        return $rows;
    }
}

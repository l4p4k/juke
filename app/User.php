<?php

namespace App;
use DB;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function post(){
        return $this->hasMany('App\Post', 'user_id');
    }

    public function message(){
        return $this->hasMany('App\Message', 'user_id');
    }

    public function subscription(){
        return $this->hasMany('App\Subscription', 'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getLoggedUser($id){
        $query = DB::table('users')
            ->where('users.id', '=', $id)
            ->first();
        return $query;
    }

}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'privilege', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Works that belong to User
    public function works()
    {
        return $this->belongsToMany('App\Work', 'user_work', 'user_id', 'work_id');
    }
    // Works that belong to User
    public function worklogs()
    {
        return $this->hasManyThrough('App\Worklog', 'App\UserWork', 'user_id', 'user_work_id', 'id');
    }

    public function getDate()
    {
        return User::find($this->id)->first()->created_at->toDateString();
    }

}

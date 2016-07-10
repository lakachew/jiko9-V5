<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worklog extends Model
{
    protected $table = 'worklogs';

    protected $fillable = [
        'user_work_id', 'description', 'created_at', 'updated_at'
    ];



    public function userWork()
    {
        return $this->belongsTo('App\UserWork');
    }

    public function maps()
    {
        return $this->hasMany('App\Map');
    }
}

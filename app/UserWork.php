<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWork extends Model
{
    protected $fillable = [
        'user_id', 'work_id', 'work_customer_id', 'created_at', 'updated_at'
    ];

    protected $table = 'user_work';


    //defining the Belongingness to worklogs
    public function worklogs()
    {
        return $this->hasMany('App\Worklog');
    }


}

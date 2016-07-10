<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'worklog_id', 'longitude', 'latitude', 'start', 'application', 'created_at', 'updated_at'
    ];

    public function worlog()
    {
        return $this->belongsTo('App\Worklog', 'worklog_id');
    }
}

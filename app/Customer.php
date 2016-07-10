<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'company_name', 'contact_name', 'email', 'phone', 'address', 'created_at', 'updated_at'
    ];

    //we are telling the customer class to use the customers table ( no need for name conventions used).
    protected $table = 'customers';

    //define relationship for has many through
    public function userWork()
    {
        //https://laravel.com/docs/5.2/eloquent-relationships#has-many-through
        return $this->hasManyThrough('App\UserWork', 'App\Work', 'customer_id', 'work_customer_id', 'id');
    }

    //define relationship for one to many
    public function works()
    {
        return $this->hasMany('App\Work', 'customer_id', 'id');
    }

    public function getDate()
    {
        return Customer::find($this->id)->first()->created_at->toDateString();
    }

}

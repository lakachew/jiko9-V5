<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    protected $fillable = [
        'customer_id', 'finished', 'address', 'description','longitude', 'latitude', 'created_at', 'updated_at'
    ];

    /**
     * Function for making one to many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    // Users that belong to work
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_works', 'work_id', 'user_id');
    }

    public function getCustomerCompanyName()
    {
        return Customer::where('id', $this->customer_id)->first()->company_name;
    }

    public function getCustomerName()
    {
        return Customer::where('id', $this->customer_id)->first()->contact_name;
    }

    public function getCustomerPhone()
    {
        return Customer::where('id', $this->customer_id)->first()->phone;
    }

    public function getCustomerEmail()
    {
        return Customer::where('id', $this->customer_id)->first()->email;
    }

    public function getCustomerDate()
    {
        return Customer::where('id', $this->customer_id)->first()->created_at->toDateString();
    }

    public function getDate()
    {
        return Customer::where('id', $this->customer_id)->first()->created_at->toDateString();
    }
}

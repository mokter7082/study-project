<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model
{
     
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
    	'anrede', 'first_name', 'last_name', 'address', 'postcode','city','phone', 'date_of_birth','picture','billing_type','status'
    ];

} 

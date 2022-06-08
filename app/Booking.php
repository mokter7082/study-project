<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'course_id', 'invoice_number', 'order_id', 'user_id', 'voucher_code', 'day_from', 'day_to', 'ticket_type', 'price', 'description', 'status'
    ];

    //packages
    public function user()
    { 
        return $this->belongsToMany('App\Users')->withTimestamps();
    }

    //course
    public function course(){
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    //Order
    public function order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}

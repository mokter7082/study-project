<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'order_code', 'invoice_number', 'customer_id', 'curse_id', 'course_type', 'discount', 'price', 'total_pay', 'order_date', 'coupon_code', 'description', 'status',
    ];

    //packages
    public function billings()
    {
        //return $this->hasMany(BillingInfo::class, 'order_id', 'id'); 
        return $this->belongsToMany('App\BillingInfo')->withTimestamps();
    }


    //course
    public function course(){
        return $this->hasOne(Course::class, 'id', 'curse_id');
    }

}

<?php 
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    protected $fillable = [
        'email',
        'email_verified_at',
        'varification_code',
        'password',
        'pass_string',
        'anrede',
        'first_name',
        'last_name',
        'name', 
        'address',
        'postcode',
        'city',
        'phone', 
        'mobile',
        'date_of_birth',
        'picture',
        'zip',
        'landline',
        'newsletter',  
        'remember_token',
        'verified',
        'status', 
    ];
 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Cagtegories
    public function countries(){
        return $this->hasOne('App\Country', 'code', 'country');
    }
}

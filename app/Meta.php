<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'referance_id', 'referance', 'meta_title', 'meta_key', 'meta_description'
    ];
    
}
 
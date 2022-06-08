<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusFlow extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'parent', 'title','initiate','step_process'
    ];

}

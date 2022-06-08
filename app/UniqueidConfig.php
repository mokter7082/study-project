<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniqueidConfig extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'model', 'prefix','suffix','uid'
    ];


	/**
	 * Set text limit in string value.
	 *
	 * @param  string  $value
	 * @return string
	 */
    public function setTextlimit($value, $num)
    {
        return substr($value, 0, $num);
    }
}

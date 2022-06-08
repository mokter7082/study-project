<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	use Sluggable;

	/**
	* The attributes that are mass assignable.
	*	
	* @var array
	*/
    protected $fillable = [
    	'title', 'slug', 'description', 'picture', 'status', 'created_by', 'updated_by'
    ];

    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

}

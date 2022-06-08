<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'title', 'slug', 'picture', 'description', 'excerpt',  'status', 'created_by', 'updated_by',
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

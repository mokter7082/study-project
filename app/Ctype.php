<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ctype extends Model
{
   use Sluggable;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'parent_id','title', 'slug', 'description', 'picture', 'sort_order','status', 'created_by', 'updated_by'
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


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
    	return $this->hasMany('App\Ctype','parent_id','id')->orderByRaw('-sort_order DESC');
    }

    //Meta
    public function meta(){
        return $this->hasOne(Meta::class, 'referance_id', 'id')->where('referance', 'ctypes');
    } 
}

<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'parent_id', 'title', 'slug', 'picture', 'description', 'template', 'status', 'created_by', 'updated_by',
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
        return $this->hasMany('App\Page','parent_id','id')->orderByRaw('-sort_order DESC');
    }


    //Meta
    public function meta(){
        return $this->hasOne(Meta::class, 'referance_id', 'id')->where('referance', 'pages');
    }


}

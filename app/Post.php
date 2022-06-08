<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{ 
	use Sluggable;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'title', 'slug', 'picture', 'description', 'post_template', 'excerpt', 'status', 'created_by', 'updated_by',
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
 

    //Cagtegories
    public function categories(){
        //return $this->belongsToMany(Category::class, 'page_category', 'page_id', 'category_id');
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
 

    //Meta
    public function meta(){
        return $this->hasOne(Meta::class, 'referance_id', 'id')->where('referance', 'posts');
    }
}

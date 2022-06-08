<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Equipments extends Model
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
 

    //Categories 
    public function categories()
    {
        // return $this->belongsTo(Category::class);
        return $this->belongsTo(Category::class, 'equipment_id', 'id');
    }

    //Meta
    public function meta(){
        return $this->hasOne(Meta::class, 'referance_id', 'id')->where('referance', 'posts');
    }
}

<?php
namespace App;
use Illuminate\Database\Eloquent\Model;  
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
	 
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'parent_id', 'sort_order', 'title', 'slug', 'description','picture','created_by', 'updated_by',
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
    	return $this->hasMany('App\Category','parent_id','id')->orderByRaw('-sort_order DESC');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function subCats()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
 

    /**
     * Get the index name for the model.
     *
     * @return string
    */

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    /**
     * The Equipments.
     *
     * @var array
     */   
    // public function equipments(){  
    //     return $this->hasMany(Equipments::class, 'id', 'id'); 
    // }

    public function equipments()
    {
        return $this->hasMany(Equipments::class, 'category_id', 'id');
    }
    
 
}

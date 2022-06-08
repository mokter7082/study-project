<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'name', 'menus_description', 'menus_type', 'parent_menus_id', 'modules_id','icon_class','menu_url','sort_number','created_by','updated_by','status'
    ];


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
    	return $this->hasMany(self::class, 'parent_id', 'id')->orderByRaw('-sort_number DESC');
    }
  

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

}

<?php 
namespace App; 
use Illuminate\Database\Eloquent\Model; 

class Quotation extends Model
{ 
	  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
       'title', 'slug', 'picture', 'description', 'post_template', 'excerpt', 'status', 'created_by', 'updated_by',
    ]; 
 
} 
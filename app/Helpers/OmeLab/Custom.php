<?php
//app/Helpers/Romans/Custom.php
namespace App\Helpers\OmeLab; 
use Illuminate\Support\Facades\DB;
use App\Widget;

class Custom {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function get_username($id) {
        $user = DB::table('users')->where('id', $id)->first();         
        return (isset($user->name) ? $user->name : '');
    }

    //Nested Category
    /**
     * @param array $cagetories
     * 
     * @return nested array 
     */
    public static function Nested($array)
    {
    	$trees=[];

    	foreach ($array as $tree) {
            $trees[$tree->id] = $tree->title;
            if (count($tree->childs)) {
                foreach ($tree->childs as $childs) {
                    $trees[$childs->id] = '- '.$childs->title;
                    if (count($childs->childs)) {
                        foreach ($childs->childs as $childs2) {
                            $trees[$childs2->id] = '&nbsp; - '.$childs2->title;
                            if (count($childs2->childs)) {
                                foreach ($childs2->childs as $childs3) {
                                    $trees[$childs3->id] = '&nbsp; &nbsp; - '.$childs3->title;
                                    if (count($childs3->childs)) {
                                        foreach ($childs3->childs as $childs4) {
                                            $trees[$childs4->id] = '&nbsp; &nbsp; &nbsp; - '.$childs4->title;
                                            if (count($childs4->childs)) {
                                                foreach ($childs4->childs as $childs5) {
                                                    $trees[$childs5->id] = '&nbsp; &nbsp; &nbsp; &nbsp; - '.$childs5->title;
                                                }
                                            }
                                        } 
                                    }
                                } 
                            }
                        } 
                    }
                } 
            }
        }

        return $trees;
    }

    /**
     * @param get  id title
     * 
     * @return array
     */
    public static function get_cities() {
        $cities = DB::table('cities')->where('title', '!=', 'All')->orderBy('title', 'ASC')->pluck('title', 'id');         
        return $cities;
    }


    /**
     * @param get  id title
     * 
     * @return array
     */
    public static function get_area_cities($id) {
        $areas = DB::table('areas')->where('city_id', $id)->orderBy('title', 'ASC')->pluck('title', 'id');
        return $areas;
    }

    /**
     * @param get slug
     * 
     * @return Boolean when match category by slug
     */
    public static function get_activeslug($slug = NULL)
    {   
        $cslug = request()->segment(2);

        if ($slug == NULL) {
           return false;
        }

        if ($slug == $cslug) {            
            return 'active';
        }

        if ($cslug) {
            $fq = DB::table('categories')->where('slug', $cslug)->first();

            if ($fq  && $fq->parent != 0) {
                $child = DB::table('categories')->where('id',  $fq->parent)->first();

                if ( $slug == $child->slug ) {
                    return 'active opened';
                }else{

                    $child2 = DB::table('categories')->where('id',  $child->parent)->first();

                    if ($child2 && $slug == $child2->slug ) {
                        return 'active opened';
                    }
                }
            }
        
        }
    }



    /**
    * @param get slug
    * 
    * @return Boolean when match category by slug
    */
    public static function get_breadcumb()
    {   
        $return = '<ul class="breadcumbs"><li><a href="'. url('/') .'"> Home</a></li>';

        $seg1 = request()->segment(1);

        if ($seg1 =='details') {
            $pid = request()->segment(2);
            $catid = DB::table('product_category')->where('product_id', $pid)->pluck('category_id')->first();
            $cslug = DB::table('categories')->where('id', $catid)->pluck('slug')->first();
        }else if ($seg1 =='category') {
            $cslug = request()->segment(2);
        }
        
        if (isset($cslug)) { 

            $fq = DB::table('categories')->where('slug', $cslug)->first();

            if ($fq && $fq->parent == 0) {
                $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $fq->slug ).'"> '.$fq->title.'</a></li>';
            }else{

                $child = DB::table('categories')->where('id', $fq->parent)->first();

                if ($child  && $child->parent == 0) {
                $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $child->slug ).'"> '.$child->title.'</a></li>';
                }else{

                    $child2 = DB::table('categories')->where('id', $child->parent)->first();

                    if ($child2  && $child2->parent == 0) {
                    $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $child2->slug ).'"> '.$child2->title.'</a></li>';
                    }else{
                        $child3 = DB::table('categories')->where('id', $child2->parent)->first();

                        if ($child3  && $child3->parent == 0) {
                        $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $child3->slug ).'"> '.$child3->title.'</a></li>';
                        }
                                                
                        $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $child2->slug ).'"> '.$child2->title.'</a></li>';

                    }
                    
                    $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $child->slug ).'"> '.$child->title.'</a></li>';

                }

                $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/category/'. $fq->slug ).'"> '.$fq->title.'</a></li>';

            }                
        } 

        if ($seg1 =='details') {
            $pid = request()->segment(2);
            $ptitle =  DB::table('products')->where('id',$pid)->pluck('name')->first();

            $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url('/details/'. $pid ).'"> '. $ptitle.'</a></li>';

        }

        if($seg1 !='details' && $seg1 !='category'){
            $pg = DB::table('pages')->where('slug', $seg1)->first();
            $return .= '<li><span><i class="fa fa-angle-right"></i></span><a href="'.url($pg->slug ).'"> '.ucfirst(strtolower($pg->title)).'</a></li>'; 
        }

        $return .=  '</ul>';

        return   $return;
    }
 

    /**
    * @param get slug
    * 
    * @return Boolean when match category by slug
    */
    public static function get_discountPrice($cartcontent, $total){
        $regPrice = 0;

        if (!is_object($cartcontent) || !(array)$cartcontent) {
           return 0;
        }

        foreach($cartcontent as $cartItem){
            $rprice = $cartItem->options->regprice > $cartItem->price ? $cartItem->options->regprice : $cartItem->price;
            $regPrice += (int)( $rprice * $cartItem->qty );
        }

        if ( $regPrice > $total) {
           return  ( $regPrice - $total );
        }

        return 0;
    }

    //Is Mega Menu
    public static function ismaga($childs)
    {
        if( count($childs) < 1 ){ return false; }
        foreach($childs as $child){
            if(count($child->childs)) {
                return true;
            }
        }
    }
 
    //Display widgets 
    public static function displayWidgets($referance=null, $position=null)
    {
        $data = false;
        if($referance){
            $widget = Widget::where('referance',$referance)->first(); 
            if ($position =='footer') {
                $data = "<div class='footer-widget__title'><h3>". $widget->title ."</h3></div>";
                $data .= $widget->description; 
            }else{
               $data = '<div class="widget-area">'; 
                if(!empty($widget->title)){
                    $data .= '<h2 class="widget-title">'. $widget->title .'</h2>';
                } 
                $data .= '<div class="widget-content">'; 
                $data .= $widget->description;  
                $data .= "</div>"; 
                $data .= "</div>";  
            }
            
        } 
        return $data;
    }

    

}
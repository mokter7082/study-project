<?php

use Illuminate\Support\Facades\DB;
use \Illuminate\Session\SessionManager;
use App\UniqueidConfig;

use App\Menu;
/*
* Uniquer ID Generate
---------------------------------------*/
if (! function_exists('uniqueid_configs')) {
    function keg_generate($model, $key=null, $prefix=null, $suffix=null, $force=null) {
    	$insert_key = ''; 
    	//new Unique ID Prepare
    	$unique_config = new UniqueidConfig;
    	$unique_config->model = $model.'s';
     	//query staert
		$ufig = UniqueidConfig::where('model', $model.'s');	

		if($force && $key){
			if($existKey = $ufig->where('uid', $key)->first()){
				$rid = intval(preg_replace("/[^0-9]/", '', $existKey->uid??0))+1;
				$insert_key = $key.$rid; 					
			}else{ 
				$insert_key = $key;
			}
			//insert and return;			
			$unique_config->key = $key;
			$unique_config->uid = $insert_key;
			$unique_config->save();
			return $unique_config->uid;
		}else{

			if($prefix){
			 	$ufig->where('prefix', $unique_config->setTextlimit($prefix, 3));
			 	$insert_key .= $prefix.'-';
			 	$unique_config->prefix = $unique_config->setTextlimit($prefix, 3); 	
			}

			if($key){
				$ufig->where('key', $key);
				$insert_key .= $key;
				$unique_config->key = $key;
			}

			if($suffix){ 
				$ufig->where('suffix', $unique_config->setTextlimit($suffix,3));
				$unique_config->suffix = $unique_config->setTextlimit($suffix,3);
			}

			$existKey = $ufig->orderBy('id', 'DESC')->first();

			$insert_key .= intval(preg_replace("/[^0-9]/", '', $existKey->uid??0))+1; 

			$insert_key .=  $suffix ?'-'.$suffix:null;

			$unique_config->uid = $insert_key;

			$unique_config->save();

			//return unique id
			return $unique_config->uid;
    	}
    }
}
 
 
/*
* Simple Mail
---------------------------------------*/
if (! function_exists('ome_email')) {
    function ome_email($to, $subject='Email form Contact form', $message=null, $from='info@dancezone.com', $cc=null) {
        if ($to==null || $message==null) { return false; }

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '. $from . "\r\n";
        
        if($cc){ $headers .= 'Cc: '. $cc . "\r\n"; }  

        $send = mail($to,$subject,$message,$headers);  

        if( $send == true ) {
            return true;
        }

        return false; 
    }
}

/*
* Number Formater
---------------------------------------*/
if (! function_exists('number')) {
	function number($val=null) { 
		return number_format($val??0,2,",","."); 
	}
}


/*
* get option value form settings table
---------------------------------------*/
if (! function_exists('getOptions')) {
	function getOptions($option=null) {
		if($option){
			return DB::table('settings')->where('referance', $option)->first();
		}
		return 0;
	}
}


/*
* Get Number of Credits
---------------------------------------*/
if (! function_exists('omeSlugify')) { 
	function omeSlugify($text){
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '_', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  } 
	  return $text;
	} 
}


/*
* Ration Calculation form Engine
---------------------------------------*/
if (!function_exists('omeSlug')) { 
   function omeSlug($string, $separator = '-') { 
       $re = "/(\\s|\\".$separator.")+/mu";
       $str = trim($string);
       $subst = $separator;
       $result = preg_replace($re, $subst, $str);
       return mb_strtolower($result, mb_detect_encoding($result));
   } 
}


/*
* Display Date
---------------------------------------*/
if (! function_exists('displayDate')) {
	function displayDate($date=null, $formate='Y-m-d') {
		if($date!=null){
			$time = strtotime($date);
			return date($formate, $time);
		}
		return false; 		
	}
}

 
/*
* Display Date
---------------------------------------*/
if (! function_exists('setLanguage')) {
	function setLanguage() { 
		$lenguage = DB::table('settings')->where('referance', 'language')->first();
		if ($lenguage->value) {
			session(['lenguage' => $lenguage->value]);
			return true;
		}
		session(['lenguage' => 'en']);
		return true;
	}
}
 

/*
* Display Date
---------------------------------------*/
if (! function_exists('getlantext')) {
	function getlantext($ref=null) { 

		if($ref==null){ return false ; }

		$len = (null!== session()->get('lenguage'))?session()->get('lenguage'):'en'; 
 
		$lenguage = DB::table('languages')->where('referance', $ref)->orWhere('en_text', 'Like', $ref.'%')->first();

		if ($lenguage && $len=='en') { 
			return !empty($lenguage->en_text)?$lenguage->en_text:$ref;
		}
		elseif($lenguage && $len=='ger') {
			return !empty($lenguage->ger_text)?$lenguage->ger_text:$ref;
		} 

		return $ref;
	}
} 

 
/*
 * Differnce between 2 dates 
--------------------------------------------*/
if (! function_exists('dateDiffInDays')) {
	function dateDiffInDays($from, $to)  
	{ 
	    // Calculating the difference in timestamps 
	    $diff = strtotime($to) - strtotime($from); 
	      
	    // 1 day = 24 hours 
	    // 24 * 60 * 60 = 86400 seconds 
	    return abs(round($diff / 86400)); 
	}
}


 
/*
 * Differnce between 2 dates 
--------------------------------------------*/
if (! function_exists('objString')) {
	function objString($data, $return, $separator= ' '){
		$string = []; 
		foreach ($data as  $item) {
			$string[] = $item->$return;
		}
		if (!empty($separator)) {
			return implode($separator, $string);
		}else{
			return implode(',', $string);
		}
		return null;
	}
}


 
/*
 * Differnce between 2 dates 
--------------------------------------------*/
if (! function_exists('getNews')) {
	function getNews(){
		return DB::table('news')->where('status', 'Active')->get();
	}
}


/*
 * Days form short comma separated data
--------------------------------------------*/
if (! function_exists('strweekday')) {
	function strweekday($data, $rtype=null, $lan='german'){
		$enWeek = array(
			'sat' => 'Saturday',
			'sun' => 'Sunday',
			'mon' => 'Monday',
			'tue' => 'Tuesday',
			'wed' => 'Wednesday',
			'thu' => 'Thursday',
			'fri' => 'Friday', 
		);

		$gerWeek = array(
			'sat' => 'Samstag',
			'sun' => 'Sonntag',
			'mon' => 'Montag',
			'tue' => 'Dienstag',
			'wed' => 'Mittwoch',
			'thu' => 'Donnerstag',
			'fri' => 'Freitag', 
		);  

		if(!empty($data)){
			$wdata = explode(',', $data);
		}

		$rdata = [];

		if ($lan=='english' && !empty($wdata)) {
			foreach ($wdata as $key => $value) {
				$rdata[] = $enWeek[strtolower($value)];
			}

			if ($rtype=null) {
				return implode(', ', $rdata);
			}
			return $rdata[0];
		}elseif ($lan=='german' && !empty($wdata)) {
			foreach ($wdata as $key => $value) {
				$rdata[] = $gerWeek[strtolower($value)];
			}
			if ($rtype=null) {
				return implode(', ', $rdata);
			}
			return $rdata[0];
		} 

		return false;
	}
}

/*
 * Excerpt
--------------------------------------------*/
if (! function_exists('excerpt')) {
	function excerpt($data, $limit=20){
		$str =  (isset($data->excerpt) && !empty($data->excerpt)) ? $data->excerpt : (isset($data->description)?$data->description:''); 
 
		$str = strip_tags($str);
		$str = html_entity_decode($str); 
		$str = urldecode($str);
		$str = preg_replace('/[^A-Za-z0-9]/', ' ', $str); 
		$str = preg_replace('/ +/', ' ', $str);
		$str = trim($str);

		if (!empty($str) && strlen($str) > $limit){
			return substr($str, 0, $limit) . '...';
		} 

		return $str;
	}
}


/*
 * Excerpt
--------------------------------------------*/
if (! function_exists('currentDateTime')) {
	function currentDateTime(){ 
		return  date('Y-m-d H:i:s'); 
	}
}

/*
 * Menu Builder
--------------------------------------------*/
if (! function_exists('ome_nav')) {
	function ome_nav($param=null){
		$module = isset($param['module'])?$param['module']:1;
		$data['active'] = isset($param['active'])?$param['active']:'current'; 

		$data['navs'] = Menu::where('parent_id', '=', 0)->where('modules_id', $module)
			->orderByRaw('-sort_number desc')->get();

        return view('includes.frontend.nav', $data);
	}
}

//active nav
if (! function_exists('active_nav')) { 
	function active_nav($url=null, $active='active'){ 

		if ($url === null) {return false;}
		
		$host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		$path = $_SERVER["REQUEST_URI"];  
 		$link = $host . $path;

 		$pathArr = array_filter(explode('/', $path));
 		$clink = $host;  

		if($url.'/' === $link || $url === $link ){
			return $active;
		} else if ($url === $link) {
			return $active;
		}else{ 
			foreach ($pathArr as $key => $value) {
				$clink = $clink .'/'. $value; 
				if ($url === $clink) {
					return $active;
				}
			} 
		}
 		return false;
	} 
}
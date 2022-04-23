<?php

namespace App\Services\General;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

class GeneralService
{ 

    /**
     * The attributes that should be cast to native types.
     * @var $route Route App
     * @return Boolean
    */
    public function is_allow($route,$user_id = null)
    {
        if(!$user_id) $user_id = \General::getUser()->id;
        return User::is_allow($route,$user_id);
    }

    /**
     * The attributes that should be cast to native types.
     * @var $route Route App
     * @return Boolean
    */
    public function is_allow_live_wire($route = null)
    {

        if(!isset($route)){
            $route = Route::currentRouteName();
        }
        //dd(request()->all()["updates"][0]["payload"]["method"]);
        if(isset(request()->all()["updates"][0]["payload"]["method"])){
            if(!$this->is_allow($route.".".request()->all()["updates"][0]["payload"]["method"])){
                App::abort(401, 'Unauthorized');
            }   
        }else{
            if(!$this->is_allow($route)){
                App::abort(401, 'Unauthorized');
            }
        }
        return true;
    }
    
    /**
     * Get User Info
     * @return array
    */
    public function getUser()
    {
        $user = '';
        if (Auth::guard('api')->user()) {
            $user = Auth::guard('api')->user();
        } elseif (Auth::guard('web')->user()) {
            $user = Auth::guard('web')->user();
        }
        return $user;
    }

    /**
     * Get Guest
     * @return array
    */
    public function getGuest()
    {
        $guest = false;
        if (!Auth::guard('api')->guest()) {
            $guest = false;
        } elseif (!Auth::guest()) {
            $guest = false;
        }
        return $guest;
    }

    /**
     * Get Current Route
     * @return string
     */
    public function getCurrentRoute()
    {
        $route = explode(".", Route::currentRouteName());
        return $route[0];
    }

    /**
     * Get Current Action
     * @return string
     */
    function getCurrentAction()
    {
        $app = explode(".", Route::currentRouteName());
        if (isset($app[1])) {
            return $app[1];
        } else {
            return 'index';
        }
    }

    /*
    * Get Capitalize Every Word
    * $tableName Required|String Value To Capitalize
    * $separator Optional|String Value Separator
    */
	public function getCapitalizeEveryWord($tableName,$separator="")
    {
        if(strpos($tableName, '_') !== false ){
    		$newName = "";
    		$wordsInString = explode('_', $tableName);
   			for ($i = 0; $i < count($wordsInString); $i++) {
    			$newName = $newName .( (array_key_first($wordsInString) == $i) ? "":$separator ). ucfirst($wordsInString[$i]);
    		}
			return $newName;
    	}else{
    		return ucfirst($tableName);
    	}
    }

    public function getCapitalizeEveryWordExceptFirst($phrase)
    {
        if(strpos($phrase, '_') !== false ){
            $newName = "";
            $wordsInString = explode('_', $phrase);
            for ($i = 0; $i < count($wordsInString); $i++) {
                if($i != 0){
                    $newName = $newName . ucfirst($wordsInString[$i]);
                }else{
                    $newName = $newName .$wordsInString[$i];
                }
            }
            return $newName;
        }else{
            return ucfirst($$phrase);
        }
    }

    public function camelCase($string){
        return Str::camel($string);
    }

    public function selectArray($array, $conditions)
    {
        $results = array();
        //dd($array);
        foreach ($array as $object => $values) {
            $completo = false;
            //($array[$object]['idanio']);
            /*if($array[$object]['idanio'] == 2018 && $array[$object]['idmes'] == 9){
                dd($array[$object]." es ".$completo);
            }*/
            foreach ($conditions as $key => $condition) {
                if ($array[$object][$key] == $conditions[$key]) {
                    $completo = true;
                } else {
                    //dd("array ".$array[$object][$key]." y condicion es ".$conditions[$key]." es ".$completo);
                    $completo = false;
                    break;
                }
            }
            //dd($array[$object]." es ".$completo);
            if ($completo == true) {
                array_push($results, $array[$object]);
            }
        }
        //dd($results);
        return $results;
    }


    public function selectArrayLike($array, $conditions)
    {
        $results = array();
        //dd($array);
        foreach ($array as $object => $values) {
            $completo = false;
            //($array[$object]['idanio']);
            /*if($array[$object]['idanio'] == 2018 && $array[$object]['idmes'] == 9){
                dd($array[$object]." es ".$completo);
            }*/
            foreach ($conditions as $key => $condition) {
                if (strpos($array[$object][$key], $conditions[$key]) !== false) {
                    $completo = true;
                } else {
                    //dd("array ".$array[$object][$key]." y condicion es ".$conditions[$key]." es ".$completo);
                    $completo = false;
                    break;
                }
            }
            //dd($array[$object]." es ".$completo);
            if ($completo == true) {
                array_push($results, $array[$object]);
            }
        }
        //dd($results);
        return $results;
    }

    public function singularize($params)
    {
        if (is_string($params))
        {
            $word = $params;
        } else if (!$word = $params['word']) {
            return false;
        }

        $singular = array (
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\\1ix',
            '/(vert|ind)ices$/i' => '\\1ex',
            '/^(ox)en/i' => '\\1',
            '/(alias|status)es$/i' => '\\1',
            '/([octop|vir])i$/i' => '\\1us',
            '/(cris|ax|test)es$/i' => '\\1is',
            '/(shoe)s$/i' => '\\1',
            '/(o)es$/i' => '\\1',
            '/(bus)es$/i' => '\\1',
            '/([m|l])ice$/i' => '\\1ouse',
            '/(x|ch|ss|sh)es$/i' => '\\1',
            '/(m)ovies$/i' => '\\1ovie',
            '/(s)eries$/i' => '\\1eries',
            '/([^aeiouy]|qu)ies$/i' => '\\1y',
            '/([lr])ves$/i' => '\\1f',
            '/(tive)s$/i' => '\\1',
            '/(hive)s$/i' => '\\1',
            '/([^f])ves$/i' => '\\1fe',
            '/(^analy)ses$/i' => '\\1sis',
            '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
            '/([ti])a$/i' => '\\1um',
            '/(n)ews$/i' => '\\1ews',
            '/s$/i' => ''
        );

        $irregular = array(
            'person' => 'people',
            'man' => 'men',
            'child' => 'children',
            'sex' => 'sexes',
            'move' => 'moves'
        );  

        $ignore = array(
            'equipment',
            'information',
            'rice',
            'money',
            'species',
            'series',
            'fish',
            'sheep',
            'press',
            'sms',
        );

        $lower_word = strtolower($word);
        foreach ($ignore as $ignore_word)
        {
            if (substr($lower_word, (-1 * strlen($ignore_word))) == $ignore_word)
            {
                return $word;
            }
        }

        foreach ($irregular as $singular_word => $plural_word)
        {
            if (preg_match('/('.$plural_word.')$/i', $word, $arr))
            {
                return preg_replace('/('.$plural_word.')$/i', substr($arr[0],0,1).substr($singular_word,1), $word);
            }
        }

        foreach ($singular as $rule => $replacement)
        {
            if (preg_match($rule, $word))
            {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }
}
<?php

    function aprint($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    function printa($array){aprint($array);}

    function bulk_replace($a, $b, $clear = false, $left = "{{", $right = "}}"){
        if (is_array($a) && is_string($b)){
            $array = $a;
            $string = $b;
        } else if (is_array($b) && is_string($a)){
            $array = $b;
            $string = $a;
        } else {
            echo "bulk replace error: not an array-string pair";
            die();
        }
        foreach ($array as $k=>$v) $string = str_replace ($left.$k.$right, $v, $string);
        if ($clear) $string = preg_replace("#".$left.".*?".$right."#", "", $string);
        return $string;
    }

    function urlExplode(){
		function explodeToArray($a){
			$a = preg_replace('/\?.*/','',$a);
			$a = trim($a,"/");
			$ret = explode("/", $a);
			if (count($ret) == 1 && $ret[0] == "") return array();
			return $ret;
		}
		
		global $_setting;
		$app_folder = explodeToArray($_setting['app_folder']);
		$request_uri = explodeToArray($_SERVER['REQUEST_URI']);
		$request_uri = array_slice($request_uri, count($app_folder));
		return $request_uri;
	}

    function trimEscapeForce($array, $fieldset){
		if (!is_array($array) || !is_array($fieldset)){
			echo "trimEscapeForce error: need two arrays";
			die();
		}
		//switch arrays
		if (isset($array[0])){
			$tmp = $array;
			$array = $fieldset;
			$fieldset = $tmp;
		}
		global $sql;
		$ret = array();
		foreach ($fieldset as $field){
			if (!isset($array[$field])){
				echo "trimEscapeForce: missing field (" . $field . ")";
				die();
			}
			$ret[$field] = trim($sql->escape($array[$field]));
		}
		return $ret;
	}
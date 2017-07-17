<?php

error_reporting(7);

function getPara($key){
    return $_GET[$key];
}

function saveSession($key, $value){
    $_SESSION[$key] = $value;
}

function getSession($key){
    if(isset($_SESSION[$key]))
        return $_SESSION[$key];
    return null;
}

function saveLoginid($id){
    $_SESSION["userid"] = $id;
}

function saveLogininfo($key){
    $_SESSION["userkey"] = $key;
}

function isSystemLogin(){
    if (!isset($_SESSION["userkey"])){
        return false;
    }else{
        return true;
    }
}

function current_url_set_value($key,$value) {
    $url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    return url_set_value($url,$key,$value);
}

function url_set_value($url,$key,$value) {
	$a=explode('?',$url); 
	$url_f=$a[0]; 
	$query=$a[1]; 
	parse_str($query,$arr); 
	$arr[$key]=$value; 
	return $url_f.'?'.http_build_query($arr); 
}

function mycurl($url){
    $ch = curl_init();
    $timeout = 5;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $value = curl_exec($ch);
    curl_close($ch);
    return $value;
}
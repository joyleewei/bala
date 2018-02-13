<?php
function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}

function pr($var){
    if(is_array($var)){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }else{
        var_dump($var);
    }
}

function make_excerpt($value,$length = 200){
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/',' ',strip_tags($value)));
    return str_limit($excerpt,$length);
}
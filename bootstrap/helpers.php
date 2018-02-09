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
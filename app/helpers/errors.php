<?php


function loadErorr($error='404', $exception=[]){
    $pathError =  _WEB_PATH_ERROR.'/'.$error.'.php';
    if(file_exists($pathError)){
        require $pathError;
        die;
    }
}


?>
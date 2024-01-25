<?php

class Controller{


    // protected function model($model, $rank="client"){
    protected function model($model, $rank=""){
        $path = _WEB_PATH_ROOT.'/app/models/'.$rank.'/'.$model.'.php';
        if(empty($model) && !file_exists($path)) $path = _WEB_PATH_ROOT.'/app/models/'.$model.'.php';
        if(file_exists($path)){
            require $path;
            $model = new $model;
            return $model;
        }
    }

    protected function render($view='', $rank='client', $data=[]){
        extract($data);
        $path = _WEB_PATH_VIEW."/".$rank."/".$view.".php";
        if(file_exists($path)){
            require $path;
        }else{
            loadErorr('view');
        }
    }

    

}


?>
<?php

class Router{

    static public $__url;

    static public function HandleUrl($url){
        
        self::$__url = trim($url, '/');

        if($url == '/'){
            return $url;
        }

        global $configs;
        $routers = $configs['routers'];

        if(!empty($routers)){
            foreach ($routers as $key => $router) {
                if(preg_match("~".$key."~ius", $url)){
                    $url = preg_replace("~".$key."~ius", $router, $url);
                }
            }
        }

        return $url;

    }

    static function getUrl(){
        // return
    }

    static function route($router){
        return _WEB_HOST_ROOT.'/'.$router;
    }

}





?>
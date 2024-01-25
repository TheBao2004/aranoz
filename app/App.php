<?php

class App{


    private $__controller, $__action, $__params = [];

    static public $__app;

    function __construct()
    {
        global $configs;

        self::$__app = $this;

        $this->__controller = ucfirst($configs['app']['controller']);
        $this->__action = $configs['app']['action'];

        $url = $this->getUrl();

        $url = Router::HandleUrl($url);

        $this->handleUrl($url);
    }


    private function getUrl(){
        if(!empty($_SERVER['PATH_INFO'])){
            $url = $_SERVER['PATH_INFO'];
        }else{
            $url = '/';
        }
        return $url;
    }


    private function handleUrl($url){

    global $configs;

    $urlArr = explode('/', $url);
    $urlArr = array_filter($urlArr);
    $urlArr = array_values($urlArr);

    $pathUrl = '';    

    $checkAdmin = false;

    if(!empty($urlArr[0]) && $urlArr[0]=="admin") $checkAdmin = true;

    if(!empty($urlArr)){
        foreach ($urlArr as $key => $file) {
        $pathCheck = ''; 

        $pathUrl .= $file.'/';

        $pathCheck = trim($pathUrl, '/');

        $checkUrlArr = explode('/', $pathCheck);

        $defaultAdmin = false;

            if(count($checkUrlArr) >= 0){ 
                $itemMax = ucfirst($checkUrlArr[count($checkUrlArr)-1]); 
                unset($checkUrlArr[count($checkUrlArr)-1]);
                $checkUrlStr = trim(implode('/', $checkUrlArr).'/'.$itemMax, '/');

                if($checkAdmin){
                    $path = _WEB_PATH_ROOT.'/app/controllers/'.$checkUrlStr.'.php';
                }else{
                    // $path = _WEB_PATH_ROOT.'/app/controllers/client/'.$checkUrlStr.'.php';
                    $path = _WEB_PATH_ROOT.'/app/controllers/'.$checkUrlStr.'.php';
                }

                // make action admin default
                if(!empty($urlArr[0]) && $urlArr[0]=="admin"){
                    $defaultAdmin = true; 
                    $this->__action = $configs['app']['action_admin'];
                } 
                if($defaultAdmin && count($urlArr) == 1){
                    $this->__controller = ucfirst($configs['app']['controller_admin']);
                    $controller = $this->__controller;
                    $pathAdmin = _WEB_PATH_ROOT.'/app/controllers/admin/'.$controller.'.php';
                    if(file_exists($pathAdmin)){
                        require $pathAdmin;
                    }else{
                        $this->loadError('404');
                    }
                    unset($urlArr[$key]);
                    break;
                } 

                unset($urlArr[$key]);
                if(file_exists($path)){
                    require $path;
                    if(class_exists($itemMax)){
                        $this->__controller = $itemMax;    
                    }
                    break;
                }
            } 
        }

    }else{
        // $path = _WEB_PATH_ROOT.'/app/controllers/client/'.$this->__controller.'.php';
        $path = _WEB_PATH_ROOT.'/app/controllers/'.$this->__controller.'.php';
        if(file_exists($path)){
            require $path;
        }else{
            $this->loadError('404');
        }
    }

    $urlArr = array_values($urlArr);

    if(!empty($urlArr[0])){
        $this->__action = $urlArr[0];
        unset($urlArr[0]);
    }

    if(!empty($urlArr)){
        $urlArr = array_values($urlArr);
        $this->__params = $urlArr;
    }

    if(class_exists($this->__controller)){
        $this->__controller = new $this->__controller;
        if(method_exists($this->__controller, $this->__action)){
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        }else{
            self::loadError('method');
        }
    }else{
        self::loadError('class');
    }

    }

    static public function loadError($erorr='404'){
        $pathErorr =  _WEB_PATH_ERROR.'/'.$erorr.'.php';
        if(file_exists($pathErorr)){
            require $pathErorr;
            die;
        }
    }
    



}



?>
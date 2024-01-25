<?php

class Session{


    static public function setSession($key, $value=''){
        if(!empty(session_id())){
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }
    
    static public function getSession($key=''){
    if(!empty($key)){
     if(!empty($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }else{
        return $_SESSION;
    }
        return false;
    }
    
    static public function removeSession($key=''){
        if(!empty($key)){
            unset($_SESSION[$key]);
            return true;
        }else{
            session_destroy();
            return true;
        }
        return false;
    }
    
    static public function setFlashData($key='', $value=''){
        $key = 'flash_'.$key;
        if($key){
            self::setSession($key, $value);
            return true;
        }
        return false;
    }
    
    static public function getFlashData($key=''){
        $key = 'flash_'.$key;
        $data = self::getSession($key);
        self::removeSession($key);
        return $data;
    }

}





?>
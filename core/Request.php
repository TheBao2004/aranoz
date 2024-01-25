<?php

class Request{


    static function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    static function is_Get(){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return true;
    
        }
        return false;
    }
    
    static function is_Post(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
    
        }
        return false;
    }
    
    static function getRequest($method = '')
    {
        $bodyArr = [];
    
        if (empty($method)) {
            if (Request::is_Get()) {
                if (!empty($_GET)) {
                    foreach ($_GET as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            }
    
            if (Request::is_Post()) {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            }
        } else {
            if ($method == 'get') {
                if (!empty($_GET)) {
                    foreach ($_GET as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            } elseif ($method == 'post') {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            }
        }
        return $bodyArr;
    }

    
}




?>
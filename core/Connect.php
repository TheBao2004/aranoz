<?php

namespace core;

use PDO;
use Exception;

class Connect{


    static public $Connect, $__conn;

    private function __construct($database)
    {
        
        extract($database);

        try {

            if(class_exists('PDO')){
        
                $dsn = $driver.':dbname='.$db.';host='.$host;
        
                $options = [
        
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        
                ];
        
                $conn = new PDO($dsn, $user, $pass, $options);

                self::$__conn = $conn;    
        
            }
        
        } catch (Exception $exception) {
            loadErorr('database', $exception);
        }

    }

    
    static public function Connect($database){
        if(self::$__conn == null){
            $connect = new Connect($database);
            self::$Connect = self::$__conn;
        }
        return self::$Connect;
    }






}





?>
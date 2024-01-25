<?php

namespace core;

use core\Database;

class DB{

    public static $__db;

    function __construct()
    {
    }

    static function db(){
        return new Database();
    }


}
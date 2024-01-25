<?php

namespace core;

use PDO;
use Exception;
use core\Connect;
use core\QueryBuidler;

class Database{

    use QueryBuidler;

    protected $__conn;

    function __construct(){   
        global $configs;
        $database = $configs['database'];
        $this->__conn = Connect::Connect($database);
    }



    function query($sql, $data=[], $get=false){
        try {
            $query = false;
            $statument = $this->__conn->prepare($sql);
            if(!empty($data)){
                $query = $statument->execute($data);
            }else{
                $query = $statument->execute();
            }
            if(!empty($get) && !empty($query)){
                return $statument;
            }
            return $query;
        } catch (Exception $exception) {
            loadErorr('database', $exception);
        }
    }
        
        
        function getRaw($sql){
            $statument = $this->query($sql, [], true);
            if(is_object($statument)) return $statument->fetchAll(PDO::FETCH_ASSOC);
            return false;
        }
        
        function getRow($sql){
            $statument = $this->query($sql, [], true);
            if(is_object($statument)) return $statument->fetch(PDO::FETCH_ASSOC);
            return false;
        }
        
        function insertData($table, $data){
            $keyStr = "";
            $keyIns = "";
            foreach ($data as $key => $value) {
                $keyStr .= $key.', ';
                $keyIns .= ':'.$key.', ';
            }
            $keyStr = trim($keyStr, ', ');
            $keyIns = trim($keyIns, ', ');
            $sql = "INSERT INTO `$table`($keyStr) VALUES ($keyIns)";
            return $this->query($sql, $data);
        }
        
        function updateData($table, $data, $condition=''){
            $keyUdt = "";
            foreach ($data as $key => $value) {
                $keyUdt .= $key.'=:'.$key.', ';
            }
            $keyUdt = trim($keyUdt, ', ');
            if(!empty($condition)){
                $sql = "UPDATE `$table` SET $keyUdt WHERE $condition";
            }else{
                $sql = "UPDATE `$table` SET $keyUdt";
            }
            return $this->query($sql, $data);
        }
        
        function deleteData($table, $condition=''){
            if(!empty($condition)){
                $sql = "DELETE FROM `$table` WHERE $condition";
            }else{
                $sql = "DELETE FROM `$table`";
            }
            return $this->query($sql);
        }
        
        function getCountRaw($sql){
            $statument = $this->query($sql, [], true);
            if(is_object($statument)) return $statument->rowCount();
            return false;
        }

        function getLastId(){
            return $this->__conn->lastInsertId();
        }



}



?>
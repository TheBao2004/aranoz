<?php

namespace core;

use core\Database;

class Validate{

    public $__errors=[], $__db;

    public function validate($fields, $rules){

        $__db = new Database();

        foreach ($rules as $field => $rule) {
            
            foreach ($rule as $item) {
                // if(!is_callable($item)){
                $errors = explode(':', $item);

                $error = trim($errors[0]); 

                if(count($errors) > 1){
                    $vali = trim($errors[1]);
                }

                if($error == 'required'){
                    if(isset($fields[$field])){
                        if(is_array($fields[$field])){
                            if(count($fields[$field]) == 0){
                                $this->__errors[$field] = ucfirst($field)." is required to enter";
                            } 
                        }elseif(empty(trim($fields[$field]))){
                            $this->__errors[$field] = ucfirst($field)." is required to enter";
                            continue;
                        }
                    }else{
                        if(empty($fields[$field])){
                            $this->__errors[$field] = ucfirst($field)." is required to enter";
                            continue;
                        }
                    }
                }

                if($error == 'email' && empty($this->__errors[$field])){
                    if(!preg_match("~^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$~", $fields[$field])){
                        $this->__errors[$field] = ucfirst($field)." must be is email";
                        continue;
                    }
                }

                if($error == 'phone' && empty($this->__errors[$field])){
                    if(!preg_match('~^0[0-9]{9}$~', $fields[$field])){
                        $this->__errors[$field] = ucfirst($field)." must be is phone number vietnamese";
                        continue;
                    }
                }

                if($error == 'int' && empty($this->__errors[$field])){
                    // if(!is_int($fields[$field])){
                    if(!preg_match('~^\d*$~', $fields[$field])){
                        $this->__errors[$field] = ucfirst($field)." must be is number";
                        continue;
                    }
                }

                if($error == 'string' && empty($this->__errors[$field])){
                    // if(!is_string($fields[$field])){
                    if(!preg_match("~^[a-zA-ZÀ-Ỹà-ỹĂăÂâĐđÊêÔôƠơƯư\s\_]*$~", $fields[$field])){
                        $this->__errors[$field] = ucfirst($field)." must be is string";
                        continue;
                    }
                }

                if($error == 'url' && empty($this->__errors[$field])){
                    $arrVali = explode(',', $vali);
                    foreach ($arrVali as $vl) {
                        if(trim($vl) == 'https'){
                            if(!preg_match('~^https?://(?:www\.)?[a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+(?:\/[^\s]*)?$~', $fields[$field])){
                                $this->__errors[$field] = ucfirst($field)." must be is url (https)";
                                continue;
                            }
                        }
                        if(trim($vl) == 'http'){
                            if(!preg_match('~^http://(?:www\.)?[a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+(?:\/[^\s]*)?$~', $fields[$field])){
                                $this->__errors[$field] = ucfirst($field)." must be is url (http)";
                                continue;
                            }
                        }
                    }
                }

                if($error == 'unique' && empty($this->__errors[$field])){
                    $arrVali = explode(',', $vali);
                    $table = trim($arrVali[0]);
                    $col = trim($arrVali[1]);
                    unset($arrVali[0]);
                    unset($arrVali[1]);
                    $arrId = array_values($arrVali);
                    $buidler = $__db->table($table)->where($col, 'like', $fields[$field]);
                    if(!empty($arrId)){
                        foreach ($arrId as $id) {
                            $id = trim($id);
                            $buidler = $buidler->where('id', '<>', $id);
                        }
                    }
                    $buidler = $buidler->count();
                    if(!empty($buidler)){   
                        $this->__errors[$field] = "This $field already exist in database";
                        continue;
                    }
                }

                if($error == 'in' && empty($this->__errors[$field])){
                    $arrVali = explode(',', $vali);
                    $arr = [];
                    foreach ($arrVali as $vl) {
                        $arr[] = trim($vl);
                    }
                    if(!in_array($fields[$field], $arr)){
                        $this->__errors[$field] = "This $field invalid";
                        continue;
                    }
                }

                if($error == 'other' && empty($this->__errors[$field])){
                    $arrVali = explode(',', $vali);
                    $table = trim($arrVali[0]);
                    $col = trim($arrVali[1]);
                    $datas = explode('<>', $arrVali[2]);
                    $buidler = $__db->table($table);
                    foreach ($datas as $data) {
                        $data = trim($data);
                        $buidler = $buidler->where($col, '<>', $data);
                    }
                    $buidler = $buidler->count();
                    if(!empty($buidler)){   
                        $this->__errors[$field] = "This $field already exist in database";
                        continue;
                    }
                }

                if($error == 'exists' && empty($this->__errors[$field])){
                    $arrVali = explode(',', $vali);
                    $table = trim($arrVali[0]);
                    $col = trim($arrVali[1]);
                    if(!$__db->table($table)->where($col, '=', $fields[$field])->count()){
                        $this->__errors[$field] = "This $field don't exist in database";
                        continue;
                    }
                }

                if($error == 'min' && empty($this->__errors[$field])){
                    if(is_int($fields[$field]) && $fields[$field] < $vali){
                        $this->__errors[$field] = ucfirst($field)." must be greater than ".$vali;
                        continue;
                    }
                }
                
                if($error == 'max' && empty($this->__errors[$field])){
                    if(is_int($fields[$field]) && $fields[$field] > $vali){
                        $this->__errors[$field] = ucfirst($field)." must be greater than ".$vali;
                        continue;
                    }
                }

                if($error == 'error' && empty($this->__errors[$field])){
                    $this->__errors[$field] = ucfirst($vali);
                }

            // }else{
            //     echo 123;
            //     if(empty($this->__errors[$field])) $this->__errors[$field] = $item;
            // }
               
            }
        }
    }

    public function getErrors(){
        return $this->__errors;
    }

}

?>
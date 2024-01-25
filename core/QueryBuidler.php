<?php

namespace core;

trait QueryBuidler{

    private $__sql, $__table, $__field='*', $__where, $__join, $__order, $__limit;

    public function table($table){
        $this->__table = $table;
        return $this;
    }

    public function select($field){
        $this->__field = $field;
        return $this;
    }

    public function join($table, $condition, $type="INNER"){
        $this->__join .= " $type JOIN $table ON $condition ";
        return $this;
    }

    public function where($field, $compare, $value){
        if(empty($this->__where)){
            $this->__where .= " WHERE $field $compare '$value' ";
        }else{
            $this->__where .= " AND $field $compare '$value' ";
        }
        return $this;
    } 

    public function whereOr($field, $compare, $value){
        if(empty($this->__where)){
            $this->__where .= " WHERE $field $compare '$value' ";
        }else{
            $this->__where .= " OR $field $compare '$value' ";
        }
        return $this;
    } 

    public function order($field, $offset="DESC"){
        $this->__order = " ORDER BY $field $offset ";
        return $this;
    }

    public function limit($number, $end=0){
        if(empty($end)){
            $this->__limit = " LIMIT $number ";
        }else{
            $this->__limit = " LIMIT $number, $end ";
        }
        return $this;
    }

    public function debug(){
        $table = $this->__table;
        $field = $this->__field;
        $join = $this->__join;
        $where = $this->__where;
        $order = $this->__order;
        $limit = $this->__limit;
        $this->__sql = " SELECT $field FROM $table $join $where $order $limit ";
        return $this->__sql;
    }

    public function get(){
        $sql = $this->debug();
        $all = $this->getRaw($sql);
        $this->resetVariable();
        return $all;
    }

    public function first(){
        $sql = $this->debug();
        $first = $this->getRow($sql);
        $this->resetVariable();
        return $first;
    }

    public function count(){
        $sql = $this->debug();
        $count = $this->getCountRaw($sql);
        $this->resetVariable();
        return $count;
    }





    function insert($data){
        $table = $this->__table;
        $status = $this->insertData($table, $data);
        $this->resetVariable();
        return $status;
    }

    function update($data){
        $table = $this->__table;
        $where = $this->__where;
        $where = str_replace('WHERE', '', $where);
        $this->resetVariable();
        $status = $this->updateData($table, $data, $where);
        return $status;
    }

    function delete(){
        $table = $this->__table;
        $where = $this->__where;
        $where = str_replace('WHERE', '', $where);
        $this->resetVariable();
        $status = $this->deleteData($table, $where);
        return $status;
    }





    public function lastId(){        
        return $this->getLastId();
    }   





    private function resetVariable(){
        $this->__sql = "";
        $this->__table = "";
        $this->__field = "*";
        $this->__where = "";
        $this->__join = "";
        $this->__order = "";
        $this->__limit = "";
    }

}





?>
<?php

use core\DB;

class Auth{

    static function User(){
        $id = Session::getSession('account');
        if(!empty($id)){
            $user = DB::db()->table('users')->where('id', '=', $id['id'])->first();
            return $user;
        }
        return false;
    }

}
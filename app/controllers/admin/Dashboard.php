<?php

class Dashboard extends Controller{

    public $__data = [];

    function index(){
        $this->render('header', 'admin/layouts');
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');
        $this->render('footer', 'admin/layouts');
    }

    function list(){
        echo 'list_dashboard';
    }


}




?>
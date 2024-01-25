<?php

// $domain = trim($_SERVER['SCRIPT_NAME'], '/');
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Name project
$domain = '-projectMVC/-Aranoz';


// Path constant
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_HOST_ROOT', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$domain);

define('_WEB_PATH_ADMIN', _WEB_PATH_ROOT.'/admin');
define('_WEB_HOST_ADMIN', _WEB_HOST_ROOT.'/admin');

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/app/templates');
define('_WEB_HOST_TEMPLATE_ADMIN', _WEB_HOST_TEMPLATE.'/admin');
define('_WEB_HOST_TEMPLATE_CLIENT', _WEB_HOST_TEMPLATE.'/client');

define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/app/templates');
define('_WEB_PATH_TEMPLATE_ADMIN', _WEB_PATH_TEMPLATE.'/admin');
define('_WEB_PATH_TEMPLATE_CLIENT', _WEB_PATH_TEMPLATE.'/client');
define('_WEB_PATH_VIEW', _WEB_PATH_ROOT.'/app/views');
define('_WEB_PATH_ERROR', _WEB_PATH_ROOT.'/app/errors');

// Item/Page
define('_PAGE', 5);

// require file config
$allFileConfigs = scandir('./configs');    
if(!empty($allFileConfigs)){
    foreach ($allFileConfigs as $key => $config) {
        $path = './configs/'.$config;
        if(file_exists($path) && $config != '.' && $config != '..'){
            require $path;
        }
    }
}




require './core/Session.php';
require './core/Router.php';
require './core/Middleware.php';
require './core/Validate.php';



require './core/QueryBuidler.php';
require './core/Connect.php';
require './core/Database.php';
require './core/Model.php';

require './core/DB.php';
require './core/Auth.php';

// require file helper
$allFileHelpers = scandir('./app/helpers');    
if(!empty($allFileHelpers)){
    foreach ($allFileHelpers as $key => $helper) {
        $path = './app/helpers/'.$helper;
        if(file_exists($path) && $helper != '.' && $helper != '..'){
            require $path;
        }
    }
}



require './core/Controller.php';



require './app/App.php';



require './core/Request.php';
require './core/ShareView.php';





?>
<?php

spl_autoload_register(function ($class) {
    $class = explode("\\", $class);
    $class = end($class); 

    if (file_exists(__DIR__ . "/lib/db/" . $class . ".php")) {
        require_once __DIR__ . "/lib/db/" . $class . ".php";
    }

    if (file_exists(__DIR__ . "/app/model/" . $class . ".php")) {
        require_once __DIR__ . "/app/model/" . $class . ".php";
    }

    if (file_exists(__DIR__ . "/app/controller/" . $class . ".php")) {
        require_once __DIR__ . "/app/controller/" . $class . ".php";
    }

    if (file_exists(__DIR__ . "/config/" . $class . ".php")) {
        require_once __DIR__ . "/config/" . $class . ".php";
    }
});
$config = require "config/config.php";

$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_password'],
    $config['db_name']
);

$request = $_SERVER['REQUEST_URI'];

define("BASE_PATH", "/");
#define("BASE_PATH", "/tourist-office-system/");


use admin_c\Admin_Controller;
$admin= new Admin_Controller();

use admin_m\Admin_model;
$admin_m= new Admin_model($db);



switch($request)
{
    case BASE_PATH. "login":
        $admin->login();
        break;
    case BASE_PATH . "signOut":
        $admin->signOut();
        break; 
    case BASE_PATH . "index". $_GET['id']:
        $customer->index();
        break;
    case BASE_PATH . "insertCustomer". $_GET['id']:
        $customer->insertCustomer();
        break;
    case BASE_PATH . "updateCustomer". $_GET['id'] :
        $customer->updateCustomer($id);
        break;
    case BASE_PATH . "deleteCustomers". $_GET['id'] :
        $customer->deleteCustomers($id);
        break;   
    default :
        $response = ['message' => 'no such an action'];
        echo json_encode($response);
        break;


}
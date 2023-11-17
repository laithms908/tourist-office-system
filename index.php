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


#use app\customer_m\Customer_model;
#$customer= new Customer_model($db);
#use customer_c\Customer_controller;
#$customer= new Customer_controller($db);


use admin_c\Admin_controller;
$admin= new Admin_controller($db);
use admin_m\Admin_model;
$adminm= new Admin_model($db);



switch($request)
{
    case BASE_PATH."login":
        $admin->login();
        break;
    case BASE_PATH . "bookTicket":
        $admin->bookTicket();
        break;
    default :
        $response = ['message' => 'no such an action'];
        echo json_encode($response);
        break;


}
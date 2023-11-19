<?php
session_start();

spl_autoload_register(function ($class) {
    $class = explode("\\", $class);
    $class = end($class); 

    if (file_exists(__DIR__ . "/lib/db/" . $class . ".php")) {
        require_once __DIR__ . "/lib/db/" . $class . ".php";
    }

    if (file_exists(__DIR__ . "/app/model/ $class . php")) {
        require_once __DIR__ . "/app/model/" . $class . ".php";
    }

    if (file_exists(__DIR__ . "/app/controller/ $class . php")) {
        require_once __DIR__ . "/app/controller/" . $class . ".php";
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

use Admin_model\admin_m;
use Admin_Controller\Admin_c;
$admin_m= new Admin_model($db); 
$admin= new Admin_Controller($admin_m);

use Customer_model\customer_m;
use Customer_Controller\customer_c;
$customer_m= new Customer_model($db); 
$customer= new Customer_Controller($customer_m);


switch($request)
{
    case BASE_PATH. "login":
        $admin->login();
        break;
    case BASE_PATH . "signOut":
        $admin->signOut();
        break;
    case BASE_PATH . "add":
        $admin->add();
        break;
    case BASE_PATH . "editAdmin". $_GET['id']:
        $admin->editAdmin();
        break;
    case BASE_PATH . "deleteAdmin". $_GET['id']:
        $admin->deleteAdmin();
        break;
    case BASE_PATH . "index":
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
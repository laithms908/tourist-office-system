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

use booking_m\Booking_model;
$booking= new Booking_model($db);

use city_m\City_model;
use city_c\City_controller;
$city= new City_model($db);
$cityC=new City_controller($city);

use customer_m\Customer_model;
$customer= new Customer_model();

use admin_m\Admin_model;
$admin= new Admin_model();

use company_m\Company_model;
use company_c\Company_controller;
$company= new Company_model($db);
$companyC=new Company_controller($company);

use hotel_m\Hotel_model;
$hotel= new Hotel_model();

use rating_m\Rating_model;
$rating= new Rating_model();

use ticket_m\Ticket_model;
$ticket= new Ticket_model;
var_dump($request);
switch($request)
{
    case BASE_PATH :
        echo "welcom to our tourist-office-system";
        break;    
    case BASE_PATH . "showCompanies":
        $companyC->selectCompany($_GET['id']);
        break;
    case BASE_PATH . "addcompany":
        $companyC->insertCompany();
        break;
    case BASE_PATH . "editCompany?id=" .  $_GET['id']:
        $companyC->updateCompany($_GET['id']);
        break;
    case BASE_PATH . "deleteCompany?id=" . $_GET['id']:
        $companyC->deletecompany($_GET['id']);
        break;
    case BASE_PATH. "showCities":
        $cityC->selectCities();
        break;
    case BASE_PATH . "addCity":
        $cityC->insertCity();
        break;
    case BASE_PATH . "editCity?id=" . $_GET['id']:
        $cityC->updateCity();
        break;
    case BASE_PATH . "deleteCity?id=" . $_GET['id']:
        $cityC->deleteCity();
        break;

    default :
        $response = ['message' => 'no such an action'];
        echo json_encode($response);
        break;

}
?>
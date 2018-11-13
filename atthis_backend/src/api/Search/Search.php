<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";


$key = $_POST["key"];

$result = array();

$user = $userController->getSearchResult($key);
$result["user"] = $user;
$car = $carController->getSearchResult($key);
$result["car"] = $car;
$customer = $customerController->getSearchResult($key);
$result["customer"] = $customer;


echo json_encode($result);
<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$inventory = $inventoryController->create($_POST['carId'], $_POST['userId'], $_POST['price'], $_POST['consignment']==='true');

echo json_encode($inventory->getId());
<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$carInfo = json_decode($_POST['carInfo'], true);
//$pictures = json_decode($_POST['pictures']);
//
//$picturesToStore = [];
//for ($i=0; $i<5; $i++){
//    array_push($picturesToStore, Controller\Picture\TransferPicture::transfer($pictures[$i], $i));
//}

$car = $carController->create(
    $carInfo['make'],
    $carInfo['model'],
    $carInfo['year'],
    $carInfo['vin'],
    $carInfo['mileage'],
    $carInfo['exteriorColor'],
    $carInfo['interiorColor'],
    $carInfo['fuel'],
    $carInfo['engine'],
    $carInfo['transmission'],
    $carInfo['driveType'],
    $carInfo['bodyStyle'],
    $carInfo['comments']
//    json_encode($picturesToStore)
);

$tradeIn = $tradeInController->create(
    $car->getId(),
    $_POST['sellerId'],
    $_POST['managerId']
);

echo json_encode($tradeIn->getId());
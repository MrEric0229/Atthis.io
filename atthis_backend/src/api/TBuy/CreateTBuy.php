<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$carInfo = json_decode($_POST['carInfo'], true);
$pictures = json_decode($_POST['pictures']);
$damages = json_decode($_POST['damages']);

$picturesToStore = [];
for ($i=0; $i<count($pictures); $i++){
    array_push($picturesToStore, Controller\Picture\TransferPicture::transfer($pictures[$i], $i));
}

$damageToStore = [];
for ($i=0; $i<count($damages); $i++){
    array_push($damageToStore, Controller\Picture\TransferPicture::transfer($damages[$i], 'damage'.$i));
}

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
    $carInfo['comments'],
    json_encode($picturesToStore)
)->setDamage(json_encode($damageToStore));


$TBuy = $TBuyController->create(
    $_POST['managerId'],
    $_POST['sellerId'],
    $car->getId()
);

$push->push('You have a new Task!', $TBuy->getManager()->getToken());

echo json_encode($_POST['sellerId']);
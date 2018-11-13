<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$selling = $sellingController->create(
    $_POST['managerId'],
    $_POST['accountingId'],
    $_POST['sellerId'],
    $customerController->create($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'])->getId(),
    (int) $_POST['carId'],
    $_POST['stage'],
    $_POST['tradeIn']==='true',
    $_POST['priceDrop'],
    $_POST['budget'],
    $_POST['vin1'],
    $_POST['vin2'],
    $_POST['vin3'],
    $_POST['url1'],
    $_POST['url2'],
    $_POST['url3'],
    $_POST['note'],
    substr($_POST['stage'], 0, 1) === 'I'
)->setSellingPrice($_POST['inventoryPrice']);

if ($_POST['tradeIn'] == 'true'){
    $carInfo = json_decode($_POST['carInfo'], true);

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
        null
    );

    $tradeIn = $tradeInController->create($car->getId(), $_POST['sellerId'], $_POST['managerId'], $_POST['accountingId'], $selling->getId());

    $selling->setStage('t' . $selling->getStage());
}

$push->push("You have a new Selling task!", $selling->getManager()->getToken());

$entityManager->flush();
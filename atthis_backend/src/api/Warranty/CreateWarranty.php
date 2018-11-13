<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$warranty = $warrantyController->create(
    $carController->get((int) $_POST['carId']),
    $_POST['customerId'],
    $_POST['managerId'],
    $_POST['sellerId'],
    Controller\Picture\TransferPicture::transfer($_POST['picture'], ''),
    $_POST['issue']
);

$push->push("You have a new Warranty task!", $warranty->getManager()->getToken());
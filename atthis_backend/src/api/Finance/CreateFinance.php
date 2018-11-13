<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";


$finance = $financeController->create(
    $_POST['sellingId'],
    $_POST['managerId'],
    $_POST['sellerId'],
    $_POST['accountingId']
);

$push->push('You have a new Finance task', $finance->getSeller()->getToken());

echo json_encode($finance->getId());
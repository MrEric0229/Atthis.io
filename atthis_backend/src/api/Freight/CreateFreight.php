<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$pictures = json_decode($_POST['pictures']);

$picturesToStore = [];
for ($i=0; $i<5; $i++){
    array_push($picturesToStore, Controller\Picture\TransferPicture::transfer($pictures[$i], $i));
}
 
$freight = $freightController->create(
    $_POST['carId'],
    $_POST['managerId'],
    $_POST['sellerId'],
    $_POST['prePrice'],
    $_POST['location']
);

$push->push('You have a new Freight task', $freight->getManager()->getToken());

echo json_encode($freight->getId());
<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$sellingController->addFreight((int) $_POST['freightId'], (int) $_POST['sellingId']);
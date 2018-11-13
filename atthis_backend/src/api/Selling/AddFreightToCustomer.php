<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$sellingController->addFreightToCustomer((int) $_POST['freightId'], (int) $_POST['sellingId']);
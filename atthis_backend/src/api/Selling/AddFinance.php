<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$sellingController->addFinance((int) $_POST['financeId'], (int) $_POST['sellingId']);
 
<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$tradeIn = $tradeInController->addSelling($_POST['sellingId'], $_POST['tradeInId']);
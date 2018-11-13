<?php

header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$inventories = $inventoryController->getAll();

echo json_encode($inventories);
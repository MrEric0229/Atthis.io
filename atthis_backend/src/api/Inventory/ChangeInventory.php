<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../../bootstrap.php";

$taskId = $_POST['id'];

$inventoryController->get($taskId)->setExist($_POST['exist']);

$entityManager->flush();
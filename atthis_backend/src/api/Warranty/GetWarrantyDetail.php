<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

echo json_encode($warranty = $warrantyController->get((int) $_POST['taskId'])->info());
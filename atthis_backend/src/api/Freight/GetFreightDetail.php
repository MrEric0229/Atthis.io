<?php

header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

echo json_encode($freightController->get((int) $_POST['taskId'])->info());
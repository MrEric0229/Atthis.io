<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

echo json_encode(['token' => $userController->get((int) $_POST['id'])->getToken()]);
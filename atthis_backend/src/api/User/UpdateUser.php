<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$userController->edit($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['password']);

echo json_encode(['status' => 'success']);
<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$noticeController->update($_POST['taskId']);

echo json_encode(['status' => 'success']);
<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$checkController->update($_POST['taskId']);


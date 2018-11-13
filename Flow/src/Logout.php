<?php
header('Access-Control-Allow-Origin: *');

session_start();
$msg = $_SESSION['user']."has logged out";
echo json_encode($msg);
session_destroy();
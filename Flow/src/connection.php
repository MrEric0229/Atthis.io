<?php
header('Access-Control-Allow-Origin: *');

session_start();

$username = "flowadmin2";
$password = "abcabc";
$dbServer = "localhost";
$dbName = "miphaflow";

$data = array(
    'status' => false,
);

$conn = new mysqli($dbServer,$username,$password,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
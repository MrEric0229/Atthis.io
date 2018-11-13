<?php
require_once('./constants.php');
$conn = new mysqli(HOST, USER, PASS, DATABASE);

if($conn->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $conn->connect_errno .")". $conn->connect_error;
}
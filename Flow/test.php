<?php
/**
 * Created by PhpStorm.
 * User: Lige Liu
 * Date: 2017/5/19 0019
 * Time: 上午 12:09
 */

$servername = "sushithedog.com";
$username = "flowadmin";
$password = "abcabc";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
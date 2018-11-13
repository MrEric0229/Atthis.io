<?php
//return 0: Failed
//return 1: Succeed
header('Access-Control-Allow-Origin: *');
require 'push.php';

session_start();

$username = "flowadmin2";
$password = "abcabc";
$dbServer = "localhost";
$dbName = "miphaflow";

$data = array(
    'status' => 'failed',
);

$conn = new mysqli($dbServer,$username,$password,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mode = $_POST['mode'];
//$mode = 'token';

if( strcmp($mode,'token')==0 ){
    $token = $_POST['token'];
    //$token = '9c1ea941dfac10359086794a3362c814';
//    $token = mysqli_escape_string($token);
    $sql = "SELECT id, userName, authority, firstname, lastname
            FROM user
            WHERE token= '$token'";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        $row = $result->fetch_assoc();
        $data['status'] = 'succeed';
        $data['authority'] = $row['authority'];
        $data['username'] = $row['userName'];
        $data['token'] = $token;
        $data['id'] = $row['id'];
        $data['firstname'] = $row['firstname'];
        $data['lastname'] = $row['lastname'];

        $push = new push();
//        $push_payload = $push->getClient()
//            ->push()
//            ->setPlatform('all')
//            ->addAlias($token)
//            ->resetBadge();
        $push->reset($token);

//         try {
//             $push_payload->send();
//         } catch (\JPush\Exceptions\APIConnectionException $e) {
//         } catch (\JPush\Exceptions\APIRequestException $e) {
//         }

        echo json_encode($data);
    }
    else{
        echo json_encode($data);
    }
}
else{
    $user = $_POST['username'];
    $pass = $_POST['password'];

//    $user = 'test';
//    $pass = 'test';

//    $user = $conn->real_escape_string($user);
//    var_dump($user);

    $sql = "SELECT id, userName, password, authority, firstname, lastname
            FROM user 
            WHERE userName = '$user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if( strcmp($pass,$row['password'])==0 ){
            $id = $row['id'];
            if( strcmp($mode, "web")!= 0 ){
                $salt = date('YndHis');
                $token = md5($user.$salt.$pass);
                $sql1 = "UPDATE user
                         SET token='$token'
                         WHERE id=$id";
                $conn->query($sql1);
            }
            $_SESSION['user'] = $user;
            $data['status'] = 'succeed';
            $data['authority'] = $row['authority'];
            $data['username'] = $row['userName'];
            $data['token'] = $token;
            $data['id'] = $row['id'];
            $data['firstname'] = $row['firstname'];
            $data['lastname'] = $row['lastname'];

            $push = new push();
            $push->reset($token);
//            $push_payload = $push->getClient()
//                ->push()
//                ->setPlatform('all')
//                ->addAlias($token)
//                ->resetBadge();
//
//            try {
//                $push_payload->send();
//            } catch (\JPush\Exceptions\APIConnectionException $e) {
//            } catch (\JPush\Exceptions\APIRequestException $e) {
//            }
            echo json_encode($data);
        }
        else{
            echo json_encode($data);
        }
    } else {
        echo json_encode($data);
    }
}
$conn->close();

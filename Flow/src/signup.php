<?php
header('Access-Control-Allow-Origin: *');

require 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$auth     = $_POST['authority'];

$token    = $_POST['token'];

//$userAdmin = $_POST['useradmin'];
//$passAdmin = $_POST['passadmin'];

//$username = 'test4';
//$password = 'test2';
//$auth     = 'test';

//$userAdmin = 'superadmin';
//$passAdmin = 'ILCwLOYHFBU270Iw2F';

//$userAdmin = 'admin';
//$passAdmin = 'admin';

$data = array(
    'status' => 'failed',
);

$authAdmin = getAuth($token, $conn);

//$sql = "SELECT authority
//        FROM user
//        WHERE userName='$userAdmin'";
//$result = $conn->query($sql);
//$row = $result->fetch_row();
//$authAdmin =  $row['authority'];
//var_dump($authAdmin);

if( strcmp($authAdmin,"superAdmin")==0 ){
    if( strcmp($auth,"superAdmin")==0 ){
        $data['msg'] = "Permission Denied";
    }
    else{
        if( create($username, $password, $auth, $conn) ){
            $data['status'] = 'succeed';
        }
        else{
            $data['msg'] = "Username has been taken";
        }
    }
}
else if( strcmp($authAdmin,"admin")==0 ){
    if( strcmp($auth, "superAdmin")==0 || strcmp($auth, "admin")==0 ){
        $data['msg'] = "Permission Denied";
    }
    else{
        if( create($username, $password, $auth, $conn) ){
            $data['status'] = 'succeed';
        }
        else{
            $data['msg'] = "Username has been taken";
        }
    }
}
else{
    $data['msg'] = "Permission Denied";
}

echo json_encode($data);

function getAuth($token, $conn){
    $sql = "SELECT authority
            FROM user 
            WHERE token='$token'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['authority'];
}


function create($username, $password, $auth, $conn){
    $sql1 = "SELECT id
         FROM user 
         WHERE userName='$username'";
    $result = $conn->query($sql1);
    if( $result->num_rows > 0 ){
        //$data['msg'] = "Username has been taken";
        return false;
    }
    else{
        $sql2 = "INSERT INTO user(userName, password, authority)
             VALUES('$username', '$password', '$auth')";
        $conn->query($sql2);
        //$data['state'] = true;
        return true;
    }
}

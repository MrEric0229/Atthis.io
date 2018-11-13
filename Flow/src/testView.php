<?php
//require_once '/home/asdfghjkl00081/child/flow/src/Controller/UserController.php';
require_once 'UserController';

echo "hello";


$userController = new UserController();
var_dump($userController);
echo "\n";
//$status = $_GET['do'];
//
//if($status==='1'){
//    $user = 'test';
//    $pass = 'test';
//    $auth = 'test';
//    $superUser = 'superadmin';
//    $superPass = 'ILCwLOYHFBU270Iw2F';
//
//    $result = $userController->createAction($user, $pass, $auth, $superUser, $superPass);
//    if($result['status']==true){
//        echo "succeed";
//    }
//    else{
//        echo "failed";
//    }
//}

$users = $userController->indexAction();
var_dump($users);

<?php

require_once __DIR__."/../bootstrap.php";
require_once "Entity/User.php";
require_once "Controller/User.php";


$userController = new Controller\User( $entityManager );

//$userController->create('test','test','test','firstname','lastname');

//public function edit($id, $username, $authority, $firstname, $lastname)
//$userController->edit(1, 'test', 'test', 'woshi', 'nibaba');

//$userController->changePassword(1,'123321');

//if( $userController->loginWithPass('test', '123321123')==null )
//    echo "false";
//else
//    echo "true";

$userController->changeToken(1, 'testToken');

if( $userController->loginWithToken('testToken')==null )
    echo "false\n";
else
    echo "true\n";
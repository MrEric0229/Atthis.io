<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../bootstrap.php";
require_once "../Entity/User.php";
require_once "../Controller/User.php";
require_once "../general/tokenGenerator.php";

$userController = new Controller\User( $entityManager );
$tokenGenerator = new tokenGenerator();

$mode = $_POST['mode'];
$reEcho = array();
$reEcho['status'] = 'failed';
if (strcmp($mode, 'token') == 0) {
    $token = $_POST['token'];
    $user = $userController->loginWithToken($token);
    if ($user!=null) {
        //$userController->changeToken($user->getId(), $tokenGenerator->generate());

        $reEcho['status'] = 'success';
        $reEcho['username'] = $user->getUsername();
        $reEcho['token'] = $user->getToken();
        $reEcho['auth'] = $user->getAuthority();
        $reEcho['id'] = $user->getId();
        $reEcho['firstname'] = $user->getFirstname();
        $reEcho['lastname'] = $user->getLastname();
    }
} else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = $userController->loginWithPass($username, $password);
    if ($user!=null) {
        $userController->changeToken($user->getId(), $tokenGenerator->generate($user->getUsername()));

        $reEcho['status'] = 'success';
        $reEcho['username'] = $user->getUsername();
        $reEcho['token'] = $user->getToken();
        $reEcho['auth'] = $user->getAuthority();
        $reEcho['id'] = $user->getId();
        $reEcho['firstname'] = $user->getFirstname();
        $reEcho['lastname'] = $user->getLastname();
    }
}

$reEcho = json_encode($reEcho);
echo $reEcho;

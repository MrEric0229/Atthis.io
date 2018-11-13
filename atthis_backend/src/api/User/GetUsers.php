<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

echo json_encode([
    'managers' => $userController->getCertainRoles('manager'),
    'sellers' => $userController->getCertainRoles('seller'),
    'accountings' => $userController->getCertainRoles('accounting'),
    'frontDesks' => $userController->getCertainRoles('frontDesk'),
    'serviceManager' => $userController->getCertainRoles('serviceManager'),
    'detailManager' => $userController->getCertainRoles('detailManager'),
    'financeManager' => $userController->getCertainRoles('financeManager'),
]);
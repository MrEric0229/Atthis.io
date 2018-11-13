<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . "/../../bootstrap.php";

$id = $_POST['id'];

$user = $userController->get($id);
$role = $user->getAuthority();

$result = [
];

$tasks = $user->getTasks();
foreach ($tasks as $task){
    $tableName = $task->getTaskList()->getTableName();
    $taskId = $task->getTargetTaskId();
    $specificTask;

    switch ($tableName) {
        case 'TBuy':
            $specificTask = $TBuyController->get($taskId);
            break;

        case 'check':
            $specificTask = $checkController->get($taskId);
            break;

        case 'notice':
            $specificTask = $noticeController->get($taskId);
            break;

        case 'freight':
            $specificTask = $freightController->get($taskId);
            break;

        case 'service':
            $specificTask = $serviceController->get($taskId);
            break;

        case 'detail':
            $specificTask = $detailController->get($taskId);
            break;

        case 'selling':
            $specificTask = $sellingController->get($taskId);
            break;

        case 'finance':
            $specificTask = $financeController->get($taskId);
            break;

        case 'paperwork':
            $specificTask = $paperworkController->get($taskId);
            break;

        case 'warranty':
            $specificTask = $warrantyController->get($taskId);
            break;

        case 'tradeIn':
            $specificTask = $tradeInController->get($taskId);
            break;
    }

    $times = $timeController->get($tableName, $taskId);

    $timeData = [];
    /** @var Entity\Time $time */
    foreach ($times as $time){
        array_push($timeData, $time->info());
    }

    array_push($result, [
        'tableName' => $tableName,
        'id' => $taskId,
        'stage' => $specificTask->getStage(),
        'time' => $timeData,
    ]);
}

echo json_encode($result);
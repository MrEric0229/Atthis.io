<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$taskId = (int) $_POST['taskId'];
$warranty = $warrantyController->get($taskId)->setTimeController($timeController);

switch ($warranty->getStage()){
    case '0':
        $warranty->updateStage('1', $warranty->getManager()->getFullName());

        $push->push('You have a new Warranty task!', $warranty->getSeller()->getToken());
        break;

    case '1':
        if ($_POST['action']==='accept'){
            $warranty->updateStage('2', $warranty->getSeller()->getFullName());

            $push->push("Warranty $taskId has been accepted by seller", $warranty->getManager()->getToken());

            $notice = $noticeController->createNoticeAndTask("Warranty $taskId has been accepted by seller", $warranty->getSeller()->getFullName(), $warranty->getManager());
        }
        else{
            $warranty->updateStage('0', $warranty->getSeller()->getFullName());

            $push->push("Warranty $taskId has been rejected by seller", $warranty->getManager()->getToken());
        }
        break;
}
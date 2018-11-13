<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$taskId = (int) $_POST['taskId'];

$TBuy = $TBuyController->get($taskId);

$stage = $TBuy->getStage();
$result = [ 'stage' => '-1' ];

switch ($stage){
    case '0':
        $action = $_POST['action'];
        if (strcmp($action, 'accept')==0){
            $price = $_POST['price'];
            $accountingId = (int) $_POST['accountingId'];

            $accounting = $userController->get($accountingId);
            $TaskList = $taskListController->get(Entity\TaskList::TBUY);

            $TBuy->setAccounting($accounting);
            $TBuy->setAccountingPrice($price);
            $TBuy->setStage('1');

            $time = $timeController->create('TBuy', $taskId, '0', '1', $TBuy->getManager()->getFullName());
            $taskController->create($accounting, $TaskList, $taskId);
            $result['stage']='1';

            $push->push('You have a new Task!', $TBuy->getAccounting()->getToken());
        }
        else{
            $TBuy->setStage('8');
            $time = $timeController->create('TBuy', $taskId, '0', '8', $TBuy->getManager()->getFullName());
            $result['stage']='8';
        }
        break;

    case '1':
        $action = $_POST['action'];
        if (strcmp($action, 'accept')==0){
            $TBuy->setStage('2');

            $timeController->create('TBuy', $taskId, '1', '2', $TBuy->getAccounting()->getFullName());
            $result['stage']='2';

            $push->push("Task $taskId has been approved!", $TBuy->getManager()->getToken());
        }
        else{
            $TBuy->setStage('6');
            $time = $timeController->create('TBuy', $taskId, '1', '6', $TBuy->getAccounting()->getFullName());
            $result['stage']='6';

            $push->push("Task $taskId has been rejected!", $TBuy->getManager()->getToken());
        }

        break;

    case '2':
        $tradeInPrice = $_POST['tradeInPrice'];
        $retailPrice = $_POST['retailPrice'];
        $maxPrice = $_POST['maxPrice'];

        $TBuy->setStage('3');
        $TBuy->setTradeInPrice($tradeInPrice);
        $TBuy->setRetailPrice($retailPrice);
        $TBuy->setMaxPrice($maxPrice);
        $timeController->create('TBuy', $taskId, '2', '3', $TBuy->getManager()->getFullName());
        $result['stage']='3';

        $push->push("Task $taskId was updated!", $TBuy->getSeller()->getToken());
        break;

    case '3':
        $action = $_POST['action'];
        if (strcmp($action, 'accept')==0){
            $finalPrice = $_POST['finalPrice'];
            $customerInfo = $_POST['customerInfo'];

            $TBuy->setStage('4');
            $TBuy->setFinalPrice($finalPrice);
            $TBuy->setCustomInfo($customerInfo);
            $TBuy->setConsignment($_POST['consignment']==='true');
            $timeController->create('TBuy', $taskId, '3', '4', $TBuy->getSeller()->getFullName());
            $result['stage']='4';

            $push->push("Task $taskId has been paid!", $TBuy->getManager()->getToken());
            $push->push("Task $taskId has been paid!", $TBuy->getAccounting()->getToken());

            $notice = $noticeController->create("Task $taskId has been paid!", $TBuy->getSeller()->getFullName(), $TBuy->getManager(), $TBuy);
            $task = $taskController->create($TBuy->getManager(), $taskListController->get(\Entity\TaskList::NOTICE), $notice->getId());
            $TBuy->getManager()->getTasks()->add($task);
        }
        else{
            $TBuy->setStage('8');
            $time = $timeController->create('TBuy', $taskId, '3', '8', $TBuy->getSeller()->getFullName());
            $result['stage']='8';

            $push->push("Task $taskId has been canceled!", $TBuy->getManager()->getToken());

            $notice = $noticeController->create("Task $taskId has been canceled!", $TBuy->getAccounting()->getFullName(), $TBuy->getManager(), $TBuy);
            $task = $taskController->create($TBuy->getManager(), $taskListController->get(\Entity\TaskList::NOTICE), $notice->getId());
            $TBuy->getManager()->getTasks()->add($task);
        }
        break;

    case '4':
        $checkNumber = $_POST['checkNumber'];
        $transferTime = $_POST['transferTime'];
        $transferNumber = $_POST['transferNumber'];

        $accounting = $TBuy->getAccounting();

        $TBuy->setCheckNumber($checkNumber);
        $TBuy->setTransferTime($transferTime);
        $TBuy->setTransferNumber($transferNumber);
        $TBuy->setStage('5');

        $timeController->create('TBuy', $taskId, '4', '5', $TBuy->getAccounting()->getFullName());
        $result['stage']='5';

        $check = $checkController->create($accounting, $TBuy);
        $TBuy->setCheck($check);
        $timeController->create('Check', $check->getId(), '', '0', "TBuy auto generated - Last step finished by ".$TBuy->getAccounting()->getFullName());

        $task = $taskController->create($accounting, $taskListController->get(Entity\TaskList::CHECK),$check->getId());
        $accounting->getTasks()->add($task);

        $push->push("Task $taskId's check has been sent'!", $TBuy->getManager()->getToken());
        $push->push("Task $taskId's check has been sent'!", $TBuy->getSeller()->getToken());

        $notice = $noticeController->create("Task $taskId's check has been sent'!", $TBuy->getAccounting()->getFullName(), $TBuy->getManager(), $TBuy);
        $task = $taskController->create($TBuy->getManager(), $taskListController->get(\Entity\TaskList::NOTICE), $notice->getId());
        $TBuy->getManager()->getTasks()->add($task);
        break;

    case '5':
        $isLocal = $_POST['isLocal'];
        if ($isLocal === 'true'){
            $TBuy->setIsLocal(true);
        }
        else{
            $TBuy->setIsLocal(false);

            $freight = $freightController->create($TBuy->getCar(), $TBuy->getManager(), $TBuy->getSeller(), $_POST['prePrice'], $_POST['location']);
        }
        $TBuy->setStage('7');
        $timeController->create('TBuy', $taskId, '5', '7', $TBuy->getSeller()->getFullName());
        $result['stage']='7';

        $id = $TBuy->getId();
        $push->push("Task $id is complete!", $TBuy->getManager()->getToken());

        $notice = $noticeController->create("Task $taskId has been canceled!", $TBuy->getSeller()->getFullName(), $TBuy->getManager(), $TBuy);
        $task = $taskController->create($TBuy->getManager(), $taskListController->get(\Entity\TaskList::NOTICE), $notice->getId());
        $TBuy->getManager()->getTasks()->add($task);

//        if ($TBuy->getSellingPayment()!=null){
//            $payment = $TBuy->getSellingPayment();
//            $payment->setStage('2');
//            $entityManager->flush();
//
//            $timeController->create('sellingPayment', $payment->getId(), 'T1', '2', "Auto generated by Buying task - Last step finished by ".$TBuy->getSeller()->getFullName());
//
//            // TODO Change push notification msg
//            $push->push("You still need some actions on Selling Payment task $taskId!", $payment->getSelling()->getManager()->getToken());
//        }
        break;

    case '6':
        $maxPrice = $_POST['maxPrice'];

        $TBuy->setStage('3');
        $TBuy->setMaxPrice($maxPrice);
        $timeController->create('TBuy', $taskId, '6', '3', $TBuy->getManager()->getFullName());
        $result['stage']='3';

        $push->push("Task $taskId is only available for consignment now!", $TBuy->getSeller()->getToken());
        break;

}

echo json_encode($result);

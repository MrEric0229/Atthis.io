<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$taskId = $_POST['taskId'];

$selling = $sellingController->get($taskId)->setTimeController($timeController);
$stage = $selling->getStage();

switch ($stage){
    case 'I0':
        $selling->updateStage('I1', $selling->getSales()->getFullName())
            ->setPriceDrop($_POST['priceDrop']);

        $push->push("Selling task $taskId has been updated!", $selling->getManager()->getToken());
        break;

    case 'A0':
        $selling->updateStage('A1', $selling->getSales()->getFullName())
            ->setBudget($_POST['budget']);

        $push->push("Selling task $taskId has been updated!", $selling->getManager()->getToken());
        break;

    case 'W0':
        $selling->updateStage('W1', $selling->getSales()->getFullName())
            ->setBudget($_POST['budget']);

        $push->push("Selling task $taskId has been updated!", $selling->getManager()->getToken());
        break;

    case 'I1D':
        if ($_POST['action']==='accept'){
            $selling->updateStage('2', $selling->getSales()->getFullName())
                ->setSellingPrice($_POST['sellingPrice']);

            $push->pushWithNotice("Selling task $taskId has been approved by manager", $selling->getManager(), $selling->getSales());
        }
        else{
            $selling->updateStage('I0', '')
                ->setManagerPrice($_POST['managerPrice']);

            $push->push("Selling task $taskId has been rejected by manager!", $selling->getSales()->getToken());
        }
        break;

    case 'I1':
        $selling->updateStage('2', $selling->getSales()->getFullName())
            ->setSellingPrice($_POST['sellingPrice']);

        $push->pushWithNotice("Selling task $taskId has been approved by manager", $selling->getManager(), $selling->getSales());
        break;

    case 'A1':
        if ($_POST['action']==='accept'){
            $selling->updateStage('2', $selling->getManager()->getFullName())
                ->setSellingPrice($_POST['sellingPrice']);

            $push->pushWithNotice("Selling task $taskId has been approved by manager", $selling->getManager(), $selling->getSales());
        }
        else{
            $selling->updateStage('A0', $selling->getManager()->getFullName())
                ->setManagerPrice($_POST['managerPrice']);

            $push->push("Selling task $taskId has been rejected by manager!", $selling->getSales()->getToken());
        }
        break;

    case 'W1':
        if ($_POST['action']==='accept'){
            $selling->updateStage('2', $selling->getManager()->getFullName())
                ->setSellingPrice($_POST['sellingPrice']);

            $push->pushWithNotice("Selling task $taskId has been approved by manager", $selling->getManager(), $selling->getSales());
        }
        else{
            $selling->updateStage('W0', $selling->getManager()->getFullName())
                ->setManagerPrice($_POST['managerPrice']);

            $push->push("Selling task $taskId has been rejected by manager!", $selling->getSales()->getToken());
        }
        break;

    case '2':
        $selling->updateStage($_POST['stage'], $selling->getSales()->getFullName());
        break;

    case 'FP2':
        $selling->updateStage('FP3', $selling->getSales()->getFullName());

        $push->push("You have a new Selling task!", $selling->getAccounting()->getToken());
        break;

    case 'DR2':
        $selling->updateStage('DR3', $selling->getSales()->getFullName())
            ->setMode($_POST['mode'])
            ->setDeposit($_POST['deposit'])
            ->setTrackingNumber($_POST['trackingNumber'])
            ->setPhoto(Controller\Picture\TransferPicture::transfer($_POST['photo'], ''));

        $push->push("You have a new Selling task!", $selling->getAccounting()->getToken());
        break;

    case 'DF2':
        $selling->updateStage('DF3', $selling->getSales()->getFullName())
            ->setDeposit($_POST['deposit']);

        $push->push("You have a new Selling task!", $selling->getAccounting()->getToken());
        break;

    case 'DF3':
    case 'FP3':
        if ($selling->getResourceType() === 'Wholesale' || $selling->getResourceType() === 'Auction'){
            $selling->updateStage('4', $selling->getAccounting()->getFullName());

            $push->push("Selling task $taskId has been updated by accountant!", $selling->getManager()->getToken());
        }
        else{
            $selling->updateStage('8', $selling->getAccounting()->getFullName());

            $push->push("Selling task $taskId has been updated by accountant!", $selling->getSales()->getToken());
        }
        break;

    case 'DR3':
        $selling->updateStage('DR4', $selling->getAccounting()->getFullName());

        $push->push("Selling task $taskId has been updated by accountant!", $selling->getSales()->getToken());
        break;
//
//    case 'DF3':
//        if ($selling->getResourceType() === 'Wholesale' || $selling->getResourceType() === 'Auction'){
//            $selling->updateStage('4', $selling->getAccounting()->getFullName());
//        }
//        else{
//            $selling->updateStage('8', $selling->getAccounting()->getFullName());
//        }
//        break;

    case 'DR4':
        $selling->setEtaDeliveryTime(new DateTime($_POST['etaDeliveryTime']))
            ->setEtaRemainingBalanceDue(new DateTime($_POST['etaRemainingBalanceDue']));
        if ($selling->getResourceType() === 'Wholesale' || $selling->getResourceType() === 'Auction'){
            $selling->updateStage('4', $selling->getSales()->getFullName());

            $push->push("Selling task $taskId has been updated by sales!", $selling->getManager()->getToken());
        }
        else{
            $selling->updateStage('DR5', $selling->getSales()->getFullName());

            $push->push("Selling task $taskId has been updated by sales!", $selling->getAccounting()->getToken());
        }
        break;

    case 'DR5':
        $selling->updateStage('7.5', $selling->getAccounting()->getFullName());
        break;

    case '4':
        $carInfo = json_decode($_POST['carInfo'], true);
        $car = $carController->create(
            $carInfo['make'],
            $carInfo['model'],
            $carInfo['year'],
            $carInfo['vin'],
            $carInfo['mileage'],
            $carInfo['exteriorColor'],
            $carInfo['interiorColor'],
            $carInfo['fuel'],
            $carInfo['engine'],
            $carInfo['transmission'],
            $carInfo['driveType'],
            $carInfo['bodyStyle'],
            $carInfo['comments'],
            ''
        );

        $selling->updateStage('B4', $selling->getManager()->getFullName())
            ->setCar($car);

        $push->push("Selling task $taskId has been updated by manager!", $selling->getAccounting()->getToken());
        break;

    case 'B4':
        $selling->updateStage('5', $selling->getAccounting()->getFullName());

        $push->push("Selling task $taskId has been updated by accountant!", $selling->getSales()->getToken());
        break;

    case '5':
        //Inventory car. No need to create freight, service and detail
        $selling->updateStage('7.5', 'TODO');
        break;

    case '6':
        // TODO：change changedBy field
        $selling->updateStage('7', 'TODO');
        break;

    case '7':
        // TODO：change changedBy field
        $selling->updateStage('7.5', 'TODO');
        break;

    case '7.5':
        $selling->updateStage('8', 'TODO');
        break;

    case '8':
        $paper = $paperworkController->create(
            $selling->getCar(),
            $selling->getCustomer(),
            $selling,
            $selling->getAccounting(),
            $selling->getManager(),
            $selling->getSales(),
            'Picture' // TODO: lowercase?
        );

        $selling->updateStage('9', $selling->getSales()->getFullName())
            ->setPaperwork($paper);
        break;

    case '9':
        // TODO：change changedBy field
        $selling->updateStage('10', 'TODO');
        break;

    case '10':
        break;
}
$entityManager->flush();

echo json_encode($selling->getStage());
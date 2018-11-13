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
    $TaskId = $task->getTargetTaskId();

    switch ($tableName){
        case 'TBuy':
            $TBuy = $TBuyController->get($TaskId);
            $stage = $TBuy->getStage();

            switch ($role){
                case 'manager':
                    if ($stage==='0' || $stage==='2' || $stage==='6'){
                        $data = [
                            'id' => $TBuy->getId(),
                            'from' => $TBuy->getSeller() ? $TBuy->getSeller()->getFullName() : '',
                            'type' => 'TBuy',
                            'stage' => $stage
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'seller':
                    if ($stage==='3' || $stage==='5'){
                        $data = [
                            'id' => $TBuy->getId(),
                            'from' => $TBuy->getSeller()->getFullName(),
                            'type' => 'TBuy',
                            'stage' => $stage
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'accounting':
                    if ($stage==='1' || $stage==='4'){
                        $data = [
                            'id' => $TBuy->getId(),
                            'from' => $TBuy->getSeller()->getFullName(),
                            'type' => 'TBuy',
                            'stage' => $stage
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'frontDesk':
                    if ($stage==='6'){
                        $data = [
                            'id' => $TBuy->getId(),
                            'from' => $TBuy->getSeller()->getFullName(),
                            'type' => 'TBuy',
                            'stage' => $stage
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'check':
            $check = $checkController->get($TaskId);
            if ($check->getStage()==='0'){
                $TBuy = $check->getTBuy();
                $data = [
                    'id' => $check->getId(),
                    'from' => $TBuy->getSeller()->getFullName(),
                    'type' => 'Check',
                    'stage' => $TBuy->getStage()
                ];
                array_push($result, $data);
            }
            break;

        case 'notice':
            $notice = $noticeController->get($TaskId);
            if ($notice->getStage()==='0'){
                $data = [
                    'id' => $notice->getId(),
                    'from' => $notice->getGetFrom(),
                    'type' => 'Notice',
                    'stage' => $notice->getStage(),
                ];
                array_push($result, $data);
            }
            break;

        case 'freight':
            $freight = $freightController->get($TaskId);

            switch ($role){
                case 'manager':
                    if ($freight->getStage()==='0' || $freight->getStage()==='2'){
                        $data = [
                            'id' => $freight->getId(),
                            'from' => $freight->getManager()->getFullName(),
                            'type' => 'Freight',
                            'stage' => $freight->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'frontDesk':
                    if ($freight->getStage()==='1' || $freight->getStage()==='3'){
                        $data = [
                            'id' => $freight->getId(),
                            'from' => $freight->getManager()->getFullName(),
                            'type' => 'Freight',
                            'stage' => $freight->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'service':
            $service = $serviceController->get($TaskId) ;

            switch ($role){
                case 'manager':
                    if ($service->getStage()==='0' || $service->getStage()==='2' || $service->getStage()==='5'){
                        $data = [
                            'id' => $service->getId(),
                            'from' => $service->getManager()->getFullName(),
                            'type' => 'Service',
                            'stage' => $service->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'serviceManager':
                    if ($service->getStage()==='1' || $service->getStage()==='4'){
                        $data = [
                            'id' => $service->getId(),
                            'from' => $service->getManager()->getFullName(),
                            'type' => 'Service',
                            'stage' => $service->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'accounting':
                    if ($service->getStage()==='3'){
                        $data = [
                            'id' => $service->getId(),
                            'from' => $service->getManager()->getFullName(),
                            'type' => 'Service',
                            'stage' => $service->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'detail':
            $detail = $detailController->get($TaskId);

            switch ($role){
                case 'manager':
                    if ($detail->getStage()==='0' || $detail->getStage()==='2'){
                        $data = [
                            'id' => $detail->getId(),
                            'from' => $detail->getManager()->getFullName(),
                            'type' => 'Detail',
                            'stage' => $detail->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'detailManager':
                    if ($detail->getStage()==='1'){
                        $data = [
                            'id' => $detail->getId(),
                            'from' => $detail->getManager()->getFullName(),
                            'type' => 'Detail',
                            'stage' => $detail->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'selling':
            $selling = $sellingController->get($TaskId);

            switch ($role){
                case 'seller':
                    if (   $selling->getStage()==='I0'
                        || $selling->getStage()==='A0'
                        || $selling->getStage()==='W0'
                        || $selling->getStage()==='tI1'
                        || $selling->getStage()==='tI1D'
                        || $selling->getStage()==='tA1'
                        || $selling->getStage()==='tW1'
                        || $selling->getStage()==='2'
                        || $selling->getStage()==='FP2'
                        || $selling->getStage()==='FP4'
                        || $selling->getStage()==='DR2'
                        || $selling->getStage()==='DR4'
                        || $selling->getStage()==='DF2'
                        || $selling->getStage()==='DF4'
                        || $selling->getStage()==='5'
                        || $selling->getStage()==='6'
                        || $selling->getStage()==='7'
                        || $selling->getStage()==='7.5'
                        || $selling->getStage()==='8'
                        || $selling->getStage()==='9'
                    ){
                        $data = [
                            'id' => $selling->getId(),
                            'from' => $selling->getManager()->getFullName(),
                            'type' => 'Selling',
                            'stage' => $selling->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'manager':
                    if (   $selling->getStage()==='I1'
                        || $selling->getStage()==='I1D'
                        || $selling->getStage()==='A1'
                        || $selling->getStage()==='W1'
                        || $selling->getStage()==='4'
                    ) {
                        $data = [
                            'id' => $selling->getId(),
                            'from' => $selling->getManager()->getFullName(),
                            'type' => 'Selling',
                            'stage' => $selling->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'accounting':
                    if (   $selling->getStage()==='FP3'
                        || $selling->getStage()==='DR3'
                        || $selling->getStage()==='DF3'
                        || $selling->getStage()==='B4'
                        || $selling->getStage()==='DR5'
                    ) {
                        $data = [
                            'id' => $selling->getId(),
                            'from' => $selling->getManager()->getFullName(),
                            'type' => 'Selling',
                            'stage' => $selling->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'finance':
            $finance = $financeController->get($TaskId);

            switch ($role){
                case 'seller':
                    if ($finance->getStage()==='0' || $finance->getStage()==='2'){
                        $data = [
                            'id' => $finance->getId(),
                            'from' => $finance->getManager()->getFullName(),
                            'type' => 'Finance',
                            'stage' => $finance->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'financeManager':
                    if ($finance->getStage()==='1'){
                        $data = [
                            'id' => $finance->getId(),
                            'from' => $finance->getSeller()->getFullName(),
                            'type' => 'Finance',
                            'stage' => $finance->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'accounting':
                    if ($finance->getStage()==='3'){
                        $data = [
                            'id' => $finance->getId(),
                            'from' => $finance->getSeller()->getFullName(),
                            'type' => 'Finance',
                            'stage' => $finance->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'paperwork':
            $paperwork = $paperworkController->get($TaskId);

            switch ($role){
                case 'seller':
                    if ($paperwork->getStage()==='1'){
                        $data = [
                            'id' => $paperwork->getId(),
                            'from' => $paperwork->getManager()->getFullName(),
                            'type' => 'Paperwork',
                            'stage' => $paperwork->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    else if ($paperwork->getStage()==='3'){
                        $data = [
                            'id' => $paperwork->getId(),
                            'from' => $paperwork->getFrontDesk()->getFullName(),
                            'type' => 'Paperwork',
                            'stage' => $paperwork->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'manager':
                    if ($paperwork->getStage()==='0'){
                        $data = [
                            'id' => $paperwork->getId(),
                            'from' => $paperwork->getManager()->getFullName(),
                            'type' => 'Paperwork',
                            'stage' => $paperwork->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'frontDesk':
                    if ($paperwork->getStage()==='2'){
                        $data = [
                            'id' => $paperwork->getId(),
                            'from' => $paperwork->getSeller()->getFullName(),
                            'type' => 'Paperwork',
                            'stage' => $paperwork->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'warranty':
            $warranty = $warrantyController->get($TaskId);

            switch ($role){
                case 'seller':
                    if ($warranty->getStage()==='1'){
                        $data = [
                            'id' => $warranty->getId(),
                            'from' => $warranty->getSeller()->getFullName(),
                            'type' => 'Warranty',
                            'stage' => $warranty->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'manager':
                    if ($warranty->getStage()==='0'){
                        $data = [
                            'id' => $warranty->getId(),
                            'from' => 'Selling task',
                            'type' => 'Warranty',
                            'stage' => $warranty->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
            break;

        case 'tradeIn':
            $tradeIn = $tradeInController->get($TaskId);

            switch($role){
                case 'seller':
                    if ($tradeIn->getStage()==='0'
                        || $tradeIn->getStage()==='2'){
                        $data = [
                            'id' => $tradeIn->getId(),
                            'from' => $tradeIn->getSeller()->getFullName(),
                            'type' => 'Trade In',
                            'stage' => $tradeIn->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'manager':
                    if ($tradeIn->getStage()==='1'){
                        $data = [
                            'id' => $tradeIn->getId(),
                            'from' => $tradeIn->getSeller()->getFullName(),
                            'type' => 'Trade In',
                            'stage' => $tradeIn->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;

                case 'accounting':
                    if ($tradeIn->getStage()==='3'){
                        $data = [
                            'id' => $tradeIn->getId(),
                            'from' => $tradeIn->getSeller()->getFullName(),
                            'type' => 'Trade In',
                            'stage' => $tradeIn->getStage(),
                        ];
                        array_push($result, $data);
                    }
                    break;
            }
    }
}

echo json_encode($result);

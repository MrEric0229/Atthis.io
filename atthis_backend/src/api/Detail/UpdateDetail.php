<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../bootstrap.php";

$taskId = (int) $_POST['taskId'];

$detail = $detailController->get($taskId)->setTimeController($timeController);
$stage = $detail->getStage();

switch ($stage){
    case '0':
        $detailManager = $userController->get((int) $_POST['detailManager']);
        $detail->updateStage('1', $detail->getManager()->getFullName())
            ->setNote($_POST['note'])
            ->setDetailManager($detailManager);

        $taskController->create($detailManager, $taskListController->get(Entity\TaskList::DETAIL), $taskId);

        $push->push('You have a new detail task!', $detail->getDetailManager()->getToken());
        break;

    case '1':
        $pictureFromPost = $_POST['picture'];
        $pictures = json_decode($pictureFromPost);

        $picturesToStore = [];
        $index = 0;
        foreach ($pictures as $picture){
            array_push($picturesToStore, Controller\Picture\TransferPicture::transfer($picture, $index++));
//            $index++;
        }

        $detail->updateStage('2', $detail->getDetailManager()->getFullName())
            ->setPicture(json_encode($picturesToStore));

        $push->push("Detail task $taskId has been updated!", $detail->getManager()->getToken());
        break;

    case '2':
        if (strcmp($_POST['action'], 'accept')==0){
            $detail->updateStage('3', $detail->getManager()->getFullName());

            $push->pushWithNotice("Detail task $taskId is complete!", $detail->getManager(), $detail->getDetailManager());

            /** @var \Entity\Selling $selling */
            if (($selling = $detail->getSelling()) !== null ){
                if ($selling->getMode() == null){
                    $selling->setTimeController($timeController)
                        ->updateStage('7.5', "Auto generated by Detail task- last step finished by {$detail->getManager()->getFullName()}");
                }
                else{
                    $selling->setTimeController($timeController)
                        ->updateStage('DR5', "Auto generated by Detail task- last step finished by {$detail->getManager()->getFullName()}");
                }

                $push->pushWithNotice("Detail for Selling {$selling->getId()} is done", $detail->getManager(), $selling->getManager());
            }
        }
        else if (strcmp($_POST['action'], 'redo')==0){
            $detail->updateStage('1', $detail->getManager()->getFullName());

            $push->pushWithNotice("Detail task $taskId has been rejected by manager!", $detail->getManager(), $detail->getDetailManager());
        }
        else{
            $detail->updateStage('4', $detail->getManager()->getFullName());

            $push->pushWithNotice("Detail task $taskId has been rejected!", $detail->getManager(), $detail->getDetailManager());

            // TODO create new detail task
        }
        $detail->setComment($_POST['comment']);
        break;
}
$entityManager->flush();
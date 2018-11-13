<?php

namespace Controller;

require_once __DIR__ . "/../Entity/TBuy.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class TBuy
{
    /**
     * @var EntityManager;
     */
    private $entityManager;

    public function __construct( $entityManger )
    {
        $this->entityManager = $entityManger;
    }

    /**
     * @param string $managerId
     * @param string $sellerId
     * @param string $carId
     *
     * @return Entity\TBuy
     */
    public function create($managerId, $sellerId, $carId){
        /** @var Entity\TBuy $TBuy */
        $TBuy = new Entity\TBuy();
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\User', (int) $managerId);
        /** @var Entity\User $seller */
        $seller = $this->entityManager->find('Entity\User', (int) $sellerId);
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\Car', (int) $carId);

        $TBuy->setStage(0)
            ->setManager($manager)
            ->setSeller($seller)
            ->setCar($car);

        $this->entityManager->persist($TBuy);
        $this->entityManager->flush();

        $this->createTime($TBuy);

        $this->createTask($manager, $TBuy);
        $this->createTask($seller, $TBuy);

        return $TBuy;

    }

    public function edit($id, $isLocal, $stage, $price, $freight){
        $TBuy = $this->entityManager->find('Entity\\TBuy', $id);

        $TBuy->setLocal($isLocal);
        $TBuy->setStage($stage);
        $TBuy->setPrice($price);
        $TBuy->setFreight($freight);

        $this->entityManager->persist($TBuy);
        $this->entityManager->flush();

        return $TBuy;

    }

    public function delete($id){
        $TBuy = $this->entityManager->find('Entity\\TBuy', $id);

        $this->entityManager->remove($TBuy);
        $this->entityManager->flush();

    }

    /**
     * @param $id
     * @return Entity\TBuy
     */
    public function get($id){
        return $this->entityManager->find('Entity\\TBuy', $id);
    }
    /**
     * @param Entity\TBuy $TBuy
     *
     * @return Entity\Time
     */
    private function createTime($TBuy){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($TBuy->getStage())
            ->setStageFrom('')
            ->setTask('TBuy')
            ->setTaskId($TBuy->getId())
            ->setChangedBy($TBuy->getSeller() ? $TBuy->getSeller()->getFullName() : '');

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\TBuy $TBuy
     *
     * @return Entity\Task
     */
    private function createTask($user, $TBuy){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::TBUY))
            ->setTargetTaskId($TBuy->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}

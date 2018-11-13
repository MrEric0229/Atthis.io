<?php

namespace Controller;

require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Freight
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $carId
     * @param string $managerId
     * @param string $sellerId
     * @param string $prePrice
     * @param string $location
     *
     * @return Entity\Freight
     */
    public function create($carId, $managerId, $sellerId, $prePrice, $location){
        $freight = new Entity\Freight();

        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', $carId);
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', $managerId);
        /** @var Entity\User $seller */
        $seller = $this->entityManager->find('Entity\\User', $sellerId);

        $freight->setCar($car)
            ->setManager($manager)
            ->setStage('0')
            ->setPrePrice($prePrice)
            ->setLocation($location);

        $this->entityManager->persist($freight);
        $this->entityManager->flush();

        $this->createTime($seller, $freight);

        $this->createTask($manager, $freight);

        return $freight;
    }

    /**
     * @param $id
     *
     * @return Entity\Freight
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Freight', $id);
    }

    /**
     * @param Entity\Freight $freight
     * @param Entity\User $seller
     *
     * @return Entity\Time
     */
    private function createTime($seller, $freight){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($freight->getStage())
            ->setStageFrom('')
            ->setTask('freight')
            ->setTaskId($freight->getId())
            ->setChangedBy($seller->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Freight $freight
     *
     * @return Entity\Task
     */
    private function createTask($user, $freight){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::FREIGHT))
            ->setTargetTaskId($freight->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
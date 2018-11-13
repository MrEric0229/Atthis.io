<?php
/**
 * Created by PhpStorm.
 * User: ligee
 * Date: 2017/7/13
 * Time: 22:20
 */

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class Warranty
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
     * @param string $customerId
     * @param string $managerId
     * @param string $sellerId
     * @param string $picture
     * @param string $issue
     *
     * @return Entity\Warranty
     */
    public function create($carId, $customerId, $managerId, $sellerId, $picture, $issue){
        $warranty = new Entity\Warranty();

        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', $managerId);
        /** @var Entity\User $seller */
        $seller = $this->entityManager->find('Entity\\User', $sellerId);
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', $carId);
        /** @var Entity\Customer $customer */
        $customer = $this->entityManager->find('Entity\\Car', $customerId);

        $warranty->setCar($car)
            ->setCustomer($customer)
            ->setManager($manager)
            ->setSeller($seller)
            ->setPicture($picture)
            ->setIssue($issue)
            ->setStage('0');

        $this->entityManager->persist($warranty);
        $this->entityManager->flush();

        $this->createTime($warranty);

        $this->createTask($manager, $warranty);
        $this->createTask($seller, $warranty);

        return $warranty;
    }

    /**
     * @param $id
     *
     * @return Entity\Warranty
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Warranty', $id);
    }

    /**
     * @param Entity\Warranty $warranty
     * @return Entity\Time
     */
    private function createTime($warranty){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($warranty->getStage())
            ->setStageFrom('')
            ->setTask('warranty')
            ->setTaskId($warranty->getId())
            ->setChangedBy($warranty->getSeller()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Warranty $warranty
     * @return Entity\Task
     */
    private function createTask($user, $warranty){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::WARRANTY))
            ->setTargetTaskId($warranty->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
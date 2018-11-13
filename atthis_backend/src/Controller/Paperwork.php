<?php
/**
 * Created by PhpStorm.
 * User: wmxpy
 * Date: 17-7-12
 * Time: 下午9:16
 */

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class Paperwork
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Entity\Car $car, Entity\Customer $customer, Entity\Selling $selling, Entity\User $accounting, Entity\User $manager, Entity\User $seller, $type){
        $paperwork = new Entity\Paperwork();

        $paperwork->setStage('0')
            ->setCar($car)
            ->setCustomer($customer)
            ->setSeller($seller)
            ->setAccounting($accounting)
            ->setManager($manager)
            ->setSelling($selling)
            ->setType($type);

        $this->entityManager->persist($paperwork);
        $this->entityManager->flush();

        $this->createTime($paperwork);

        $this->createTask($seller, $paperwork);
        $this->createTask($accounting, $paperwork);
        $this->createTask($manager, $paperwork);

        return $paperwork;
    }

    /**
     * @param $id
     * @return Entity\Paperwork
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Paperwork', $id);
    }

    /**
     * @param Entity\Paperwork $paperWork
     *
     * @return Entity\Time
     */
    private function createTime($paperWork){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($paperWork->getStage())
            ->setStageFrom('')
            ->setTask('paperwork')
            ->setTaskId($paperWork->getId())
            ->setChangedBy($paperWork->getSeller()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Paperwork $paperWork
     *
     * @return Entity\Task
     */
    private function createTask($user, $paperWork){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::PAPERWORK))
            ->setTargetTaskId($paperWork->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
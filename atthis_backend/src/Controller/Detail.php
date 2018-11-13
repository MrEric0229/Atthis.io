<?php

namespace Controller;

use Doctrine\ORM\EntityManager;
use Entity;

require_once __DIR__."/../../vendor/autoload.php";

class Detail
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
     * @param string $managerId
     * @param string $level
     * @param string $carId
     * @return Entity\Detail
     */
    public function create($managerId, $level, $carId){
        /** @var Entity\Detail $detail */
        $detail = new Entity\Detail();
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', $managerId);
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', $carId);

        $detail->setManager($manager)
            ->setStage('0')
            ->setLevel($level)
            ->setCar($car);

        $this->entityManager->persist($detail);
        $this->entityManager->flush();

        $this->createTime($detail);

        $this->createTask($manager, $detail);

        return $detail;
    }

    /**
     * @param $id
     * @return Entity\Detail
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Detail', $id);
    }

    /**
     * @param Entity\Detail $detail
     *
     * @return Entity\Time
     */
    private function createTime($detail){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($detail->getStage())
            ->setStageFrom('')
            ->setTask('detail')
            ->setTaskId($detail->getId())
            //TODO: Change this field
            ->setChangedBy($detail->getManager()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Detail $detail
     *
     * @return Entity\Task
     */
    private function createTask($user, $detail){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::DETAIL))
            ->setTargetTaskId($detail->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
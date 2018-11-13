<?php

namespace Controller;

require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Service
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Service constructor.
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entity\Car $car
     * @param string $managerId
     * @param string $note
     * @param string $msg
     * @return Entity\Service
     */
    public function create($car, $managerId, $note, $msg=null){
        /** @var Entity\Service $service */
        $service = new Entity\Service();
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', $managerId);

        $service->setCar($car)
            ->setStage('0')
            ->setManager($manager)
            ->setNote($note);

        $this->entityManager->persist($service);
        $this->entityManager->flush();

        $this->createTime($service, $msg);
        $this->createTask($manager, $service);

        return $service;
    }

    /**
     * @param $id
     * @return Entity\Service
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Service', $id);
    }

    /**
     * @param Entity\Service $service
     * @param String $msg
     *
     * @return Entity\Time
     */
    private function createTime($service, $msg=null){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($service->getStage())
            ->setStageFrom('')
            ->setTask('service')
            ->setTaskId($service->getId())
            //TODO: Change this field
            ->setChangedBy($service->getManager()->getFullName());

        if ($msg !== null){
            $time->setChangedBy($msg);
        }

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Service $service
     *
     * @return Entity\Task
     */
    private function createTask($user, $service){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::SERVICE))
            ->setTargetTaskId($service->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
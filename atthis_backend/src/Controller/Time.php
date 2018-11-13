<?php

namespace Controller;

use Doctrine\ORM\EntityManager;
use Entity;

class Time
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @param $task string
     * @param $taskId string
     * @param $stageFrom string
     * @param $stage string
     * @param $changedBy string
     * @return Entity\Time
     */
    public function create($task, $taskId, $stageFrom, $stage, $changedBy){
        $time = new Entity\Time();

        $date = date('Y-m-d H:i:s');

        $time->setTime(new \DateTime($date))
            ->setStage($stage)
            ->setStageFrom($stageFrom)
            ->setTask($task)
            ->setTaskId($taskId)
            ->setChangedBy($changedBy);

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    public function edit($id, $task, $stage, $taskId, $date){
        $time = $this->entityManager->find('Entity\Time', $id);

        $time->setTime($date)
            ->setStage($stage)
            ->setTask($task)
            ->setTaskId($taskId);

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    public function delete($id){
        $time = $this->entityManager->find('Entity\Time', $id);

        $this->entityManager->remove($time);
        $this->entityManager->flush();
    }

//    public function get($id){
//        return $this->entityManager->find('Entity\Time', $id);
//    }

    public function get($task, $taskId){
        return  $this->entityManager->createQueryBuilder()
            ->addSelect('t')
            ->from('Entity\Time', 't')
            ->where('t.task = :task')
            ->andWhere('t.taskId = :taskId')
            ->setParameter('task', $task)
            ->setParameter('taskId', $taskId)
            ->getQuery()
            ->getResult();
    }
}
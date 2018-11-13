<?php

namespace Controller;

require_once __DIR__ . "/../Entity/Task.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Task{
    
    /**
    * @var EntityManager;
    */
    private $entityManager;
    
    public function __construct( $entityManger )
    {
        $this->entityManager = $entityManger;
    }

    public function create(Entity\User $user, Entity\TaskList $taskList, $targetTaskId){
        $task = new Entity\Task();

        $task->setUser($user);
        $task->setTaskList($taskList);
        $task->setTargetTaskId($targetTaskId);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    public function edit($id, Entity\User $user, Entity\TaskList $taskList, $targetTaskId){
        $task = $this->entityManager->find('Entity\Task', $id);

        $task->setUser($user);
        $task->setTaskList($taskList);
        $task->setTargetTaskId($targetTaskId);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    public function delete($id){
        $task = $this->entityManager->find('Entity\Task', $id);

        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function findTargetTask($user){
        return $task = $this->entityManager->find('Entity\\Task', $user);
    }
}
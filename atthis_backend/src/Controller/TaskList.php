<?php

namespace Controller;

require_once __DIR__ . "/../Entity/TaskList.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class TaskList
{
  /**
   * @var EntityManager;
   */
  private $entityManager;

  public function __construct( $entityManger )
  {
      $this->entityManager = $entityManger;
  }

  public function create($tableName){
      $taskList = new Entity\TaskList();
      $taskList->setTableName($tableName);

      $this->entityManager->persist($taskList);
      $this->entityManager->flush();

      return $taskList;
  }

  public function edit($id, $tableName){
      $taskList = $this->entityManager->find('Entity\\TaskList', $id);

      $taskList->setTableName($tableName);

      $this->entityManager->persist($taskList);
      $this->entityManager->flush();

      return $taskList;
  }

  public function delete($id){
      $taskList = $this->entityManager->find('Entity\\TaskList', $id);

      $this->entityManager->remove($taskList);
      $this->entityManager->flush();

      return $taskList;
  }

    /**
     * @param $id
     * @return null|Entity\TaskList
     */
  public function get($id){
      return $this->entityManager->find('Entity\\TaskList', $id);
  }
}

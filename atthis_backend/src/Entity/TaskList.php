<?php

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
/**
* Class TaskList
* @Entity
* @Table(name="atthis_task_list")
*/
class TaskList{

    const TBUY = 1;
    const CHECK = 2;
    const NOTICE = 3;
    const FREIGHT = 4;
    const SERVICE = 5;
    const DETAIL = 6;
    const INVENTORY = 7;
    const SELLING = 8;
    const FINANCE = 9;
    const PAPERWORK = 10;
    const WARRANTY = 11;
    const TRADEIN = 12;

    /**
    * @var integer
    * @Column(type="integer")
    * @Id
    * @GeneratedValue
    */
    protected $id;

    /**
    * @var string
    * @Column(nullable=false)
    */
    protected $tableName;

     /**
      * @var Task[]
      * @OneToMany(targetEntity="Task", mappedBy="taskList")
      */
     protected $task;

    public function  __construct(){

    }

    /**
    * @return int
    */
    public function getId(){
        return $this->id;
    }

    /**
    * @param int $id
    */
    public function setId($id){
        $this->id = $id;
    }

    /**
    * @return string
    */
    public function getTableName(){
        return $this->tableName;
    }

    /**
    * @param string $tableName
    */
    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    // /**
    //  * @return Tasks
    //  */
    // public function getTask()
    // {
    //     return $this->task;
    // }
    //
    // /**
    //  * @param Tasks $task
    //  */
    // public function setTask($task)
    // {
    //     $this->task = $task;
    // }


}

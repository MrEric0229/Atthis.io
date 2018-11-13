<?php
namespace Entity;

/**
* @Entity
* @Table(name="atthis_task")
*/
class Task{

    /**
    * @var integer
    * @Column(type="integer")
    * @Id
    * @GeneratedValue
    */
    protected $id;

    /**
    * @var User
    * @ManyToOne(targetEntity="User", inversedBy="task")
    */
    protected $user;

    /**
    * @var TaskList
    * @ManyToOne(targetEntity="TaskList", inversedBy="task")
    */
    protected $taskList;

    /**
    * @var integer
    * @Column( type="integer", nullable=false)
    */
    protected $targetTaskId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return TaskList
     */
    public function getTaskList()
    {
        return $this->taskList;
    }

    /**
     * @param TaskList $taskList
     * @return Task
     */
    public function setTaskList($taskList)
    {
        $this->taskList = $taskList;
        return $this;
    }

    /**
     * @return int
     */
    public function getTargetTaskId()
    {
        return $this->targetTaskId;
    }

    /**
     * @param int $targetTaskId
     * @return Task
     */
    public function setTargetTaskId($targetTaskId)
    {
        $this->targetTaskId = $targetTaskId;
        return $this;
    }
}
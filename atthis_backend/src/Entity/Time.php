<?php

namespace Entity;
use Entity;

/**
 * Class Time
 * @Entity
 * @Table(name="atthis_time")
 */
class Time
{
    /**
     * @var integer
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $task;

    /**
     * @var integer
     * @Column(type="integer", nullable=false)
     */
    protected $taskId;

    /**
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $stage;

    /**
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $stageFrom;

    /**
     * @var \DateTime
     * @Column(type="datetime", nullable=false)
     */
    protected $time;

    /**
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $changedBy;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Time
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param string $task
     * @return Time
     */
    public function setTask($task)
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     * @return Time
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     * @return Time
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     * @return Time
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getChangedBy()
    {
        return $this->changedBy;
    }

    /**
     * @param string $changedBy
     * @return Time
     */
    public function setChangedBy($changedBy)
    {
        $this->changedBy = $changedBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getStageFrom()
    {
        return $this->stageFrom;
    }

    /**
     * @param string $stageFrom
     * @return Time
     */
    public function setStageFrom($stageFrom)
    {
        $this->stageFrom = $stageFrom;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stageFrom' => $this->stageFrom,
            'stageTo' => $this->stage,
            'taskId' => $this->taskId,
            'task' => $this->task,
            'time' => $this->time,
            'changedBy' => $this->changedBy
        ];
    }
}
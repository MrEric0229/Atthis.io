<?php

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_detail")
 */
class Detail
{

    /**
     * @var integer
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="detailManager")
     */
    protected $manager;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $level;

    /**
     * @var Car
     * @OneToOne(targetEntity="Car", inversedBy="detail")
     */
    protected $car;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="detailDetailManager")
     */
    protected $detailManager;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $picture;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $note;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $comment;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $stage;

    /**
     * @var Notice
     * @OneToMany(targetEntity="Notice", mappedBy="detail")
     */
    protected $notice;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="detail")
     */
    protected $selling;

    /**
     * @var Controller\Time
     */
    protected $timeController;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Detail
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Selling
     */
    public function getSelling()
    {
        return $this->selling;
    }

    /**
     * @param Selling $selling
     * @return Detail
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
        return $this;
    }

    /**
     * @return User
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param User $manager
     * @return Detail
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $level
     * @return Detail
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * @param Car $car
     * @return Detail
     */
    public function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return User
     */
    public function getDetailManager()
    {
        return $this->detailManager;
    }

    /**
     * @param User $detailManager
     * @return Detail
     */
    public function setDetailManager($detailManager)
    {
        $this->detailManager = $detailManager;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return Detail
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Detail
     */
    public function setNote($note)
    {
        $this->note = $note;
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
     * @return Detail
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @param Controller\Time $time
     * @return $this
     */
    public function setTimeController($time){
        $this->timeController = $time;
        return $this;
    }

    /**
     * @return Controller\Time
     */
    public function getTimeController(){
        return $this->timeController;
    }

    /**
     * @param string $stage
     * @param string $changedBy
     * @return $this
     */
    public function updateStage($stage, $changedBy){
        $this->timeController->create('detail', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Detail
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return Notice
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param Notice $notice
     * @return Detail
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'detailManager' => $this->detailManager ? $this->detailManager->getFullName() : '',
            'level' => $this->level,
            'picture' => $this->picture,
            'note' => $this->note,
            'comment' => $this->comment,
            'carInfo' => $this->car ? $this->car->info() : [],
        ];
    }
}
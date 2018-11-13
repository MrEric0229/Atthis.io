<?php

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_service")
 */
class Service
{

    /**
     * @var integer
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var Car
     * @OneToOne(targetEntity="Car", inversedBy="service")
     */
    protected $car;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="serviceManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="serviceAccounting")
     */
    protected $accounting;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="serviceServiceManager")
     */
    protected $serviceManager;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $note;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $price;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $managerPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $finalPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $pickedUpBy;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $checkedBy;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $resultReport;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $stage;

    /**
     * @var Notice
     * @OneToMany(targetEntity="Notice", mappedBy="service")
     */
    protected $notice;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="service")
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
     * @return Service
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
     * @return Service
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
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
     * @return Service
     */
    public function setCar($car)
    {
        $this->car = $car;
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
     * @return Service
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return User
     */
    public function getAccounting()
    {
        return $this->accounting;
    }

    /**
     * @param User $accounting
     * @return Service
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
        return $this;
    }

    /**
     * @return User
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param User $serviceManager
     * @return Service
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
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
     * @return Service
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Service
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getManagerPrice()
    {
        return $this->managerPrice;
    }

    /**
     * @param string $managerPrice
     * @return Service
     */
    public function setManagerPrice($managerPrice)
    {
        $this->managerPrice = $managerPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getFinalPrice()
    {
        return $this->finalPrice;
    }

    /**
     * @param string $finalPrice
     * @return Service
     */
    public function setFinalPrice($finalPrice)
    {
        $this->finalPrice = $finalPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickedUpBy()
    {
        return $this->pickedUpBy;
    }

    /**
     * @param string $pickedUpBy
     * @return Service
     */
    public function setPickedUpBy($pickedUpBy)
    {
        $this->pickedUpBy = $pickedUpBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckedBy()
    {
        return $this->checkedBy;
    }

    /**
     * @param string $checkedBy
     * @return Service
     */
    public function setCheckedBy($checkedBy)
    {
        $this->checkedBy = $checkedBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultReport()
    {
        return $this->resultReport;
    }

    /**
     * @param string $resultReport
     * @return Service
     */
    public function setResultReport($resultReport)
    {
        $this->resultReport = $resultReport;
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
     * @return Service
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @param string $stage
     * @param string $changedBy
     * @return Service
     */
    public function updateStage($stage, $changedBy){
        $this->timeController->create('service', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
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
     * @return Service
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
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

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'price' => $this->price,
            'finalPrice' => $this->finalPrice,
            'managerPrice' => $this->managerPrice,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'accounting' => $this->accounting ? $this->accounting->getFullName() : '',
            'serviceManager' => $this->serviceManager ? $this->serviceManager->getFullName() : '',
            'pickedUpBy' => $this->pickedUpBy,
            'checkedBy' => $this->checkedBy,
            'resultReport' => $this->resultReport,
            'note' => $this->note,
            'carInfo' => $this->car ? $this->car->info() : [],
        ];
    }
}
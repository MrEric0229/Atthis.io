<?php

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_freight")
 */
class Freight
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
     * @Column(type="string", nullable=false)
     */
    protected $stage;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $prePrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $finalPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $note;

    /**
     * @var Car
     * @ManyToOne(targetEntity="Car", inversedBy="freight")
     */
    protected $car;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $location;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="freightManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="freightFrontDesk")
     */
    protected $frontDesk;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="freight")
     */
    protected $selling;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="freightToCustomer")
     */
    protected $selling2;

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
     *
     * @return Freight
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Selling
     */
    public function getSelling2()
    {
        return $this->selling2;
    }

    /**
     * @param Selling $selling2
     * @return Freight
     */
    public function setSelling2($selling2)
    {
        $this->selling2 = $selling2;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrePrice()
    {
        return $this->prePrice;
    }

    /**
     * @param string $prePrice
     *
     * @return Freight
     */
    public function setPrePrice($prePrice)
    {
        $this->prePrice = $prePrice;
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
     *
     * @return Freight
     */
    public function setFinalPrice($finalPrice)
    {
        $this->finalPrice = $finalPrice;
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
     *
     * @return Freight
     */
    public function setNote($note)
    {
        $this->note = $note;
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
     *
     * @return Freight
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
     *
     * @return Freight
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return User
     */
    public function getFrontDesk()
    {
        return $this->frontDesk;
    }

    /**
     * @param User $frontDesk
     *
     * @return Freight
     */
    public function setFrontDesk($frontDesk)
    {
        $this->frontDesk = $frontDesk;
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
     *
     * @return Freight
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @param string $stage
     * @param string $changedBy
     * @return $this
     */
    public function updateStage($stage, $changedBy){
        $this->timeController->create('freight', $this->id, $this->stage, $stage, $changedBy);

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
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
     * @return Freight
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'prePrice' => $this->prePrice,
            'finalPrice' => $this->finalPrice,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'frontDesk' => $this->frontDesk? $this->frontDesk->getFullName() : '',
            'note' => $this->note,
            'location' => $this->location,
            'carInfo' => $this->car ? $this->car->info() : [],
        ];
    }
}
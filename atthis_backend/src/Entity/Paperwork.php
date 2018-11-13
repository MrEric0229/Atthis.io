<?php

namespace Entity;

use Controller;

/**
 * @Entity
 * @Table(name="atthis_paperwork")
 */
class Paperwork
{

    /**
     * @var integer
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var Customer
     * @OneToOne(targetEntity="Customer", inversedBy="paperwork")
     */
    protected $customer;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", inversedBy="paperwork")
     */
    protected $selling;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="paperworkFrontDesk")
     */
    protected $frontDesk;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="paperworkAccounting")
     */
    protected $accounting;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="paperworkManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="paperworkSeller")
     */
    protected $seller;

    /**
     * @var Car
     * @ManyToOne(targetEntity="Car", inversedBy="paperwork")
     */
    protected $car;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $tracking;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $pickUp;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $stage;

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
     * @return Paperwork
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Paperwork
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
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
     * @return Paperwork
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
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
     * @return Paperwork
     */
    public function setFrontDesk($frontDesk)
    {
        $this->frontDesk = $frontDesk;
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
     * @return Paperwork
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     * @return Paperwork
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return User
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param User $seller
     * @return Paperwork
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
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
     * @return Paperwork
     */
    public function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Paperwork
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * @param string $tracking
     * @return Paperwork
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickUp()
    {
        return $this->pickUp;
    }

    /**
     * @param string $pickUp
     * @return Paperwork
     */
    public function setPickUp($pickUp)
    {
        $this->pickUp = $pickUp;
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
     * @return Paperwork
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
        $this->timeController->create('paperwork', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'selling' => $this->selling ? $this->selling->info() : '',
            'frontDesk' => $this->frontDesk ? $this->frontDesk->getFullName() : '',
            'accounting' => $this->accounting ? $this->accounting->getFullName() : '',
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'seller' => $this->seller ? $this->seller->getFullName() : '',
            'car' => $this->car ? $this->car->info() : [],
            'customer' => $this->customer? $this->customer : [],
            'type' => $this->type,
            'tracking' => $this->tracking,
            'pickUp' => $this->pickUp,
            'stage' => $this->stage,
        ];
    }
}
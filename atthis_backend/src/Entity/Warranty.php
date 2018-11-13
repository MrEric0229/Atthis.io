<?php
/**
 * Created by PhpStorm.
 * User: ligee
 * Date: 2017/7/13
 * Time: 21:49
 */

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_warranty")
 */
class Warranty
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
     * @Column(type="string", nullable=true)
     */
    protected $stage;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $issue;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $picture;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="warrantyManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="warrantySeller")
     */
    protected $seller;

    /**
     * @var Customer
     * @ManyToOne(targetEntity="Customer", inversedBy="warranties")
     */
    protected $customer;

    /**
     * @var Car
     * @ManyToOne(targetEntity="Car", inversedBy="warranties")
     */
    protected $car;

    /**
     * @var Controller\Time
     */
    private $timeController;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Warranty
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * @param string $issue
     * @return Warranty
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;
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
     * @return Warranty
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
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
     * @return Warranty
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
     * @return Warranty
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
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
     * @return Warranty
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
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
     * @return Warranty
     */
    public function setCar($car)
    {
        $this->car = $car;
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
     * @return Warranty
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
        $this->timeController->create('warranty', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'seller' => $this->seller ? $this->seller->getFullName() : '',
            'issue' => $this->issue,
            'picture' => $this->picture,
            'car' => $this->car ? $this->car->info() : [],
            'customer' => $this->customer ? $this->customer->info() : [],
        ];
    }
}
<?php

namespace Entity;

/**
 * Class Check
 * @Entity
 * @Table(name="atthis_inventory")
 */
class Inventory{
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
    protected $exist;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $price;

    /**
     * @var Car
     * @OneToOne(targetEntity="Car", inversedBy="inventory")
     */
    protected $car;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="inventoryUser")
     */
    protected $user;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=false)
     */
    protected $consignment;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Inventory
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getExist()
    {
        return $this->exist;
    }

    /**
     * @param string $exist
     * @return Inventory
     */
    public function setExist($exist)
    {
        $this->exist = $exist;
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
     * @return Inventory
     */
    public function setCar($car)
    {
        $this->car = $car;
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
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Inventory
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param User $user
     * @return Inventory
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isConsignment()
    {
        return $this->consignment;
    }

    /**
     * @param boolean $consignment
     * @return Inventory
     */
    public function setConsignment($consignment)
    {
        $this->consignment = $consignment;
        return $this;
    }
}
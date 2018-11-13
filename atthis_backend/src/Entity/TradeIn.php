<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="atthis_trade_in")
 */
class TradeIn
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
     * @var Car
     * @ManyToOne(targetEntity="Car", inversedBy="tradeIn")
     */
    protected $car;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $price;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="tradeInManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="tradeInSeller")
     */
    protected $seller;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="tradeInAccounting")
     */
    protected $accounting;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", inversedBy="tradeInEntity")
     */
    protected $selling;

    /**
     * @var \Controller\Time
     */
    protected $timeController;

    /**
     * @param string $stage
     * @param string $changedBy
     * @return TradeIn
     */
    public function updateStage($stage, $changedBy)
    {
        $this->timeController->create('tradeIn', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TradeIn
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return TradeIn
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
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
     * @return TradeIn
     */
    public function setCar($car)
    {
        $this->car = $car;
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
     * @return TradeIn
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return TradeIn
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
     * @return TradeIn
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
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
     * @return TradeIn
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     * @return TradeIn
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
        return $this;
    }

    /**
     * @return \Controller\Time
     */
    public function getTimeController()
    {
        return $this->timeController;
    }

    /**
     * @param \Controller\Time $timeController
     * @return TradeIn
     */
    public function setTimeController($timeController)
    {
        $this->timeController = $timeController;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'seller' => $this->seller ? $this->seller->getFullName() : '',
            'accounting'=>$this->accounting ? $this->accounting->getFullName() : '',
            'customer'=>$this->selling->getCustomer()->info(),
            'car' => $this->car ? $this->car->info() : [],
            'price' => $this->price,
        ];
    }

}
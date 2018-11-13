<?php

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_selling")
 */
class Selling
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
     * @OneToOne(targetEntity="Car", inversedBy="selling")
     */
    protected $car;

    /**
     * @var Customer
     * @ManyToOne(targetEntity="Customer", inversedBy="selling")
     */
    protected $customer;

    /**
     * @var Freight
     * @OneToOne(targetEntity="Freight", inversedBy="selling")
     */
    protected $freight;

    /**
     * @var Finance
     * @OneToOne(targetEntity="Finance", inversedBy="selling")
     */
    protected $finance;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="sellingSales")
     */
    protected $sales;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="sellingManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="sellingAccounting")
     */
    protected $accounting;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $priceDrop;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $managerPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $sellingPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $budget;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $url1;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $url2;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $url3;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $vin1;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $vin2;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $vin3;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $payment;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $remaining;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=true)
     */
    protected $tradeIn;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $tradeInPrice;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $note;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $resourceType;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $deposit;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $mode;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $trackingNumber;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $photo;

    /**
     * @var \DateTime
     * @Column(type="datetime", nullable=true)
     */
    protected $etaDeliveryTime;

    /**
     * @var \DateTime
     * @Column(type="datetime", nullable=true)
     */
    protected $etaRemainingBalanceDue;

    /**
     * @var Controller\Time
     */
    protected $timeController;

    /**
     * @var Service
     * @OneToOne(targetEntity="Service", inversedBy="selling")
     */
    protected $service;

    /**
     * @var Detail
     * @OneToOne(targetEntity="Detail", inversedBy="selling")
     */
    protected $detail;

    /**
     * @var Paperwork
     * @OneToOne(targetEntity="Paperwork", inversedBy="selling")
     */
    protected $paperwork;

    /**
     * @var Freight
     * @OneToOne(targetEntity="Freight", inversedBy="selling2")
     */
    protected $freightToCustomer;

    /**
     * @var TradeIn
     * @OneToOne(targetEntity="TradeIn", mappedBy="selling")
     */
    protected $tradeInEntity;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=true)
     */
    protected $inventory;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Selling
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param string $sellingPrice
     * @return Selling
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
        return $this;
    }

    /**
     * @return Freight
     */
    public function getFreightToCustomer()
    {
        return $this->freightToCustomer;
    }

    /**
     * @param Freight $freightToCustomer
     * @return Selling
     */
    public function setFreightToCustomer($freightToCustomer)
    {
        $this->freightToCustomer = $freightToCustomer;
        return $this;
    }

    /**
     * @return Paperwork
     */
    public function getPaperwork()
    {
        return $this->paperwork;
    }

    /**
     * @param Paperwork $paperwork
     * @return Selling
     */
    public function setPaperwork($paperwork)
    {
        $this->paperwork = $paperwork;
        return $this;
    }

    /**
     * @return Detail
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param Detail $detail
     * @return Selling
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     * @return Selling
     */
    public function setService($service)
    {
        $this->service = $service;
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
     * @return Selling
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinance()
    {
        return $this->finance;
    }

    /**
     * @param Finance $finance
     * @return Selling
     */
    public function setFinance($finance)
    {
        $this->finance = $finance;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceDrop()
    {
        return $this->priceDrop;
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
     * @return Selling
     */
    public function setManagerPrice($managerPrice)
    {
        $this->managerPrice = $managerPrice;
        return $this;
    }

    /**
     * @param string $priceDrop
     * @return Selling
     */
    public function setPriceDrop($priceDrop)
    {
        $this->priceDrop = $priceDrop;
        return $this;
    }

    /**
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param string $budget
     * @return Selling
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl1()
    {
        return $this->url1;
    }

    /**
     * @param string $url1
     * @return Selling
     */
    public function setUrl1($url1)
    {
        $this->url1 = $url1;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl2()
    {
        return $this->url2;
    }

    /**
     * @param string $url2
     * @return Selling
     */
    public function setUrl2($url2)
    {
        $this->url2 = $url2;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl3()
    {
        return $this->url3;
    }

    /**
     * @param string $url3
     * @return Selling
     */
    public function setUrl3($url3)
    {
        $this->url3 = $url3;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin1()
    {
        return $this->vin1;
    }

    /**
     * @param string $vin1
     * @return Selling
     */
    public function setVin1($vin1)
    {
        $this->vin1 = $vin1;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin2()
    {
        return $this->vin2;
    }

    /**
     * @param string $vin2
     * @return Selling
     */
    public function setVin2($vin2)
    {
        $this->vin2 = $vin2;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin3()
    {
        return $this->vin3;
    }

    /**
     * @param string $vin3
     * @return Selling
     */
    public function setVin3($vin3)
    {
        $this->vin3 = $vin3;
        return $this;
    }

    /**
     * @return TradeIn
     */
    public function getTradeInEntity()
    {
        return $this->tradeInEntity;
    }

    /**
     * @param TradeIn $tradeInEntity
     * @return Selling
     */
    public function setTradeInEntity($tradeInEntity)
    {
        $this->tradeInEntity = $tradeInEntity;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param string $payment
     * @return Selling
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemaining()
    {
        return $this->remaining;
    }

    /**
     * @param string $remaining
     * @return Selling
     */
    public function setRemaining($remaining)
    {
        $this->remaining = $remaining;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isTradeIn()
    {
        return $this->tradeIn;
    }

    /**
     * @param boolean $tradeIn
     * @return Selling
     */
    public function setTradeIn($tradeIn)
    {
        $this->tradeIn = $tradeIn;
        return $this;
    }

    /**
     * @return string
     */
    public function getTradeInPrice()
    {
        return $this->tradeInPrice;
    }

    /**
     * @param string $tradeInPrice
     * @return Selling
     */
    public function setTradeInPrice($tradeInPrice)
    {
        $this->tradeInPrice = $tradeInPrice;
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
     * @param $stage
     * @return $this
     */
    public function setStage($stage){
        $this->stage = $stage;
        return $this;
    }

    /**
     * @param string $stage
     * @param string $changedBy
     * @return Selling
     */
    public function updateStage($stage, $changedBy)
    {
        $this->timeController->create('selling', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    /**
     * @return Freight
     */
    public function getFreight()
    {
        return $this->freight;
    }

    /**
     * @param Freight $freight
     * @return Selling
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;
        return $this;
    }

    /**
     * @return User
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @param User $sales
     * @return Selling
     */
    public function setSales($sales)
    {
        $this->sales = $sales;
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
     * @return Selling
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
     * @return Selling
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     * @return Selling
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
     * @return Selling
     */
    public function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * @param string $resourceType
     * @return Selling
     */
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
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
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     * @return Selling
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return Selling
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Selling
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * @param string $deposit
     * @return Selling
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEtaDeliveryTime()
    {
        return $this->etaDeliveryTime;
    }

    /**
     * @param \DateTime $etaDeliveryTime
     * @return Selling
     */
    public function setEtaDeliveryTime($etaDeliveryTime)
    {
        $this->etaDeliveryTime = $etaDeliveryTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEtaRemainingBalanceDue()
    {
        return $this->etaRemainingBalanceDue;
    }

    /**
     * @param \DateTime $etaRemainingBalanceDue
     * @return Selling
     */
    public function setEtaRemainingBalanceDue($etaRemainingBalanceDue)
    {
        $this->etaRemainingBalanceDue = $etaRemainingBalanceDue;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isInventory()
    {
        return $this->inventory;
    }

    /**
     * @param boolean $inventory
     * @return Selling
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;
        return $this;
    }

    public function fixedinfo(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'managerId' => $this->manager ? $this->manager->getId() : '-1',
            'accounting' => $this->accounting ? $this->accounting->getFullName() : '',
            'accountingId' => $this->accounting ? $this->accounting->getId() : '',
            'seller' => $this->sales ? $this->sales->getFullName() : '',
            'sellerId' => $this->sales ? $this->sales->getId() : '',
            'customer' => $this->customer ? $this->customer->info() : [],
            'car' => $this->car ? $this->car->info() : [],
            'budget' => $this->budget,
            'priceDrop' => $this->priceDrop,
            'url' => $this->url,
            'vin' => $this->vin,
            'payment' => $this->payment,
            'remaining' => $this->remaining,
            'tradeIn' => $this->tradeIn,
            'tradeInPrice' => $this->tradeInPrice,
            'note' => $this->note,
            'managerPrice' => $this->managerPrice,
            'mode' => $this->mode,
            'deposit' => $this->deposit,
            'trackingNumber' => $this->trackingNumber,
            'photo' => $this->photo,
            'sellingPrice' => $this->sellingPrice,
        ];
    }

    public function info()
    {   
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'managerId' => $this->manager ? $this->manager->getId() : '-1',
            'accounting' => $this->accounting ? $this->accounting->getFullName() : '',
            'accountingId' => $this->accounting ? $this->accounting->getId() : '',
            'seller' => $this->sales ? $this->sales->getFullName() : '',
            'sellerId' => $this->sales ? $this->sales->getId() : '',
            'customer' => $this->customer ? $this->customer->info() : [],
            'car' => $this->car ? $this->car->info() : [],
            'budget' => $this->budget,
            'priceDrop' => $this->priceDrop,
            'url1' => $this->url1,
            'url2' => $this->url2,
            'url3' => $this->url3,
            'vin1' => $this->vin1,
            'vin2' => $this->vin2,
            'vin3' => $this->vin3,
            'payment' => $this->payment,
            'remaining' => $this->remaining,
            'tradeIn' => $this->tradeIn,
            'tradeInPrice' => $this->tradeInPrice,
            'note' => $this->note,
            'managerPrice' => $this->managerPrice,
            'mode' => $this->mode,
            'deposit' => $this->deposit,
            'trackingNumber' => $this->trackingNumber,
            'photo' => $this->photo,
            'sellingPrice' => $this->sellingPrice,
            'freight1' => $this->freight ? $this->freight->info() : [],
            'freight2' => $this->freightToCustomer ? $this->freightToCustomer->info() : [],
            'service' => $this->service ? $this->service->info() : [],
            'detail' => $this->detail ? $this->detail->info() : [],
            'finance' => $this->finance ? $this->finance->info() : [],
            'tradeInCarInfo' => $this->tradeIn ? $this->tradeInEntity->getCar()->info() : [],
            'inventory' => $this->inventory,
        ];
    }
}
<?php

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Entity;

/**
* Class TBuy
* @Entity
* @Table(name="atthis_tbuy")
*/
class TBuy{
    /**
    * @var integer
    * @Column(type="integer")
    * @Id
    * @GeneratedValue
    */
    protected $id;
    
    /**
    * @var boolean
    * @Column(type="boolean", nullable=true)
    */
    protected $isLocal;
    
    /**
    * @var integer
    * @Column(nullable=false)
    */
    protected $stage;
    
    /**
    * @var string
    * @Column(nullable=true)
    */
    protected $accountingPrice;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $tradeInPrice;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $retailPrice;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $maxPrice;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $finalPrice;

    /**
    * @var string
    * @Column(nullable=true)
    */
    protected $freight;

    /**
     * @var Car
     * @OneToOne(targetEntity="Car", inversedBy="TBuy")
     */
    protected $car;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="TBuyManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="TBuySeller")
     */
    protected $seller;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="TBuyAccounting")
     */
    protected $accounting;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="TBuyFrontDesk")
     */
    protected $frontDesk;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $customInfo;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $transferTime;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $transferNumber;

    /**
     * @var string
     * @Column(nullable=true)
     */
    protected $checkNumber;

    /**
     * @var Check
     * @OneToOne(targetEntity="Check", mappedBy="TBuy")
     */
    protected $check;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Notice", mappedBy="TBuy")
     */
    protected $notices;

    /**
     * @var boolean
     * @Column(type="boolean", nullable=true)
     */
    protected $consignment;
    
    public function  __construct()
    {
        $this->notices = new ArrayCollection();
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
     * @return TBuy
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsLocal()
    {
        return $this->isLocal;
    }

    /**
     * @param boolean $isLocal
     * @return TBuy
     */
    public function setIsLocal($isLocal)
    {
        $this->isLocal = $isLocal;
        return $this;
    }

    /**
     * @return int
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param int $stage
     * @return TBuy
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountingPrice()
    {
        return $this->accountingPrice;
    }

    /**
     * @param string $accountingPrice
     * @return TBuy
     */
    public function setAccountingPrice($accountingPrice)
    {
        $this->accountingPrice = $accountingPrice;
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
     * @return TBuy
     */
    public function setTradeInPrice($tradeInPrice)
    {
        $this->tradeInPrice = $tradeInPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getRetailPrice()
    {
        return $this->retailPrice;
    }

    /**
     * @param string $retailPrice
     * @return TBuy
     */
    public function setRetailPrice($retailPrice)
    {
        $this->retailPrice = $retailPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param string $maxPrice
     * @return TBuy
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
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
     * @return TBuy
     */
    public function setFinalPrice($finalPrice)
    {
        $this->finalPrice = $finalPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getFreight()
    {
        return $this->freight;
    }

    /**
     * @param string $freight
     * @return TBuy
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;
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
     * @return TBuy
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
     * @return TBuy
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
     * @return TBuy
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
     * @return TBuy
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     * @return TBuy
     */
    public function setFrontDesk($frontDesk)
    {
        $this->frontDesk = $frontDesk;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomInfo()
    {
        return $this->customInfo;
    }

    /**
     * @param string $customInfo
     * @return TBuy
     */
    public function setCustomInfo($customInfo)
    {
        $this->customInfo = $customInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransferTime()
    {
        return $this->transferTime;
    }

    /**
     * @param string $transferTime
     * @return TBuy
     */
    public function setTransferTime($transferTime)
    {
        $this->transferTime = $transferTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransferNumber()
    {
        return $this->transferNumber;
    }

    /**
     * @param string $transferNumber
     * @return TBuy
     */
    public function setTransferNumber($transferNumber)
    {
        $this->transferNumber = $transferNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckNumber()
    {
        return $this->checkNumber;
    }

    /**
     * @param string $checkNumber
     * @return TBuy
     */
    public function setCheckNumber($checkNumber)
    {
        $this->checkNumber = $checkNumber;
        return $this;
    }

    /**
     * @return Check
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * @param Check $check
     * @return TBuy
     */
    public function setCheck($check)
    {
        $this->check = $check;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getNotices()
    {
        return $this->notices;
    }

    /**
     * @param ArrayCollection $notices
     * @return TBuy
     */
    public function setNotices($notices)
    {
        $this->notices = $notices;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'stage' => $this->stage,
            'roleInfo' => [
                'seller' => $this->seller ? $this->seller->getFullName() : '',
                'accounting' => $this->accountingPrice ? $this->accounting->getFullName() : '',
                'manager' => $this->manager ? $this->manager->getFullName() : '',
            ],
            'carInfo' => $this->car ? $this->car->info() : [],
            'accountingPrice' => $this->accountingPrice,
            'tradeInPrice' => $this->tradeInPrice,
            'retailPrice' => $this->retailPrice,
            'maxPrice' => $this->maxPrice,
            'finalPrice' => $this->finalPrice,
            'consignment' => $this->consignment,
        ];
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
     * @return TBuy
     */
    public function setConsignment($consignment)
    {
        $this->consignment = $consignment;
        return $this;
    }
}
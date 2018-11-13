<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Car
 * @Entity
 * @Table(name="atthis_car")
 */
class Car
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
     * @Column(nullable=false)
     */
    protected $make;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $model;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $year;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $vin;

    /**
     * @var string
     * @column(nullable=false)
     */
    protected $mileage;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $exteriorColor;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $interiorColor;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $fuel;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $engine;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $transmission;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $driveType;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $bodyStyle;

    /**
     * @var string
     * @Column(nullable=false)
     */
    protected $comments;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $picture;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $damage;

    /**
     * @var TBuy
     * @OneToOne(targetEntity="TBuy", mappedBy="car")
     */
    protected $TBuy;

    /**
     * @var Freight
     * @OneToMany(targetEntity="Freight", mappedBy="car")
     */
    protected $freight;

    /**
     * @var Inventory
     * @OneToOne(targetEntity="Inventory", mappedBy="car")
     */
    protected $inventory;

    /**
     * @var Service
     * @OneToOne(targetEntity="Service", mappedBy="car");
     */
    protected $service;

    /**
     * @var Detail
     * @OneToOne(targetEntity="Detail", mappedBy="car")
     */
    protected $detail;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="car")
     */
    protected $selling;

    /**
     * @var Paperwork
     * @OneToMany(targetEntity="Paperwork", mappedBy="car")
     */
    protected $paperwork;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Warranty", mappedBy="car")
     */
    protected $warranties;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="TradeIn", mappedBy="car")
     */
    protected $tradeIn;

    public function __construct()
    {
        $this->warranties = new ArrayCollection();
        $this->freight = new ArrayCollection();
        $this->tradeIn = new ArrayCollection();
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
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param string $make
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     * @return Car
     */
    public function setVin($vin)
    {
        $this->vin = $vin;
        return $this;
    }

    /**
     * @return string
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param string $mileage
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * @return string
     */
    public function getExteriorColor()
    {
        return $this->exteriorColor;
    }

    /**
     * @param string $exteriorColor
     * @return Car
     */
    public function setExteriorColor($exteriorColor)
    {
        $this->exteriorColor = $exteriorColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getInteriorColor()
    {
        return $this->interiorColor;
    }

    /**
     * @param string $interiorColor
     * @return Car
     */
    public function setInteriorColor($interiorColor)
    {
        $this->interiorColor = $interiorColor;
        return $this;
    }

    /**
     * @return string
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * @param string $fuel
     * @return Car
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param string $engine
     * @return Car
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransmission()
    {
        return $this->transmission;
    }

    /**
     * @param string $transmission
     * @return Car
     */
    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;
        return $this;
    }

    /**
     * @return string
     */
    public function getDriveType()
    {
        return $this->driveType;
    }

    /**
     * @param string $driveType
     * @return Car
     */
    public function setDriveType($driveType)
    {
        $this->driveType = $driveType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBodyStyle()
    {
        return $this->bodyStyle;
    }

    /**
     * @param string $bodyStyle
     * @return Car
     */
    public function setBodyStyle($bodyStyle)
    {
        $this->bodyStyle = $bodyStyle;
        return $this;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     * @return Car
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
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
     * @return Car
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param string $damage
     * @return Car
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTradeIn()
    {
        return $this->tradeIn;
    }

    /**
     * @param ArrayCollection $tradeIn
     * @return Car
     */
    public function setTradeIn($tradeIn)
    {
        $this->tradeIn = $tradeIn;
        return $this;
    }

    /**
     * @return TBuy
     */
    public function getTBuy()
    {
        return $this->TBuy;
    }

    /**
     * @param TBuy $TBuy
     * @return Car
     */
    public function setTBuy($TBuy)
    {
        $this->TBuy = $TBuy;
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
     * @return Car
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;
        return $this;
    }

    /**
     * @return Inventory
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * @param Inventory $inventory
     * @return Car
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;
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
     * @return Car
     */
    public function setService($service)
    {
        $this->service = $service;
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
     * @return Car
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
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
     * @return Car
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
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
     * @return Car
     */
    public function setPaperwork($paperwork)
    {
        $this->paperwork = $paperwork;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getWarranties()
    {
        return $this->warranties;
    }

    /**
     * @param ArrayCollection $warranties
     * @return Car
     */
    public function setWarranties($warranties)
    {
        $this->warranties = $warranties;
        return $this;
    }

    /**
     * @return array
     */
    public function info(){
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'vin' => $this->vin,
            'mileage' => $this->mileage,
            'exteriorColor' => $this->exteriorColor,
            'interiorColor' => $this->interiorColor,
            'fuel' => $this->fuel,
            'engine' => $this->engine,
            'transmission' => $this->transmission,
            'driveType' => $this->driveType,
            'bodyStyle' => $this->bodyStyle,
            'comments' => $this->comments,
            'pictures' => $this->picture,
            'damages' => $this->damage,
        ];
    }

    /**
     * @return Car
     */
    public function cloneCar(){
        /** @var Car $car */
        $car = new Car();

        $car->setMake($this->make)
            ->setModel($this->model)
            ->setYear($this->getYear())
            ->setVin($this->getVin())
            ->setMileage($this->mileage)
            ->setExteriorColor($this->exteriorColor)
            ->setInteriorColor($this->interiorColor)
            ->setFuel($this->fuel)
            ->setEngine($this->engine)
            ->setTransmission($this->transmission)
            ->setDriveType($this->driveType)
            ->setBodyStyle($this->bodyStyle)
            ->setComments($this->comments)
            ->setPicture($this->picture);

        return $car;
    }


@RequestMapping("/get-by-email")
@ResponseBody
public String getByEmail(String email) {
String userId = "";
try {
    User user = userDao.findByEmail(email);

    if (user.getPassword() == password)
    {
        return "sucess";
    }
    else{
        return false;
    }
    }
    catch (Exception ex) {
        return "User not found";
    }
        return "The user id is: " + userId;
    }
}
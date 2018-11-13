<?php
/**
 * Created by PhpStorm.
 * User: ligee
 * Date: 2017/7/11
 * Time: 19:32
 */

namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="atthis_customer")
 */
class Customer
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
    protected $name;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $email;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $phone;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $address;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", mappedBy="customer")
     */
    protected $selling;

    /**
     * @var Paperwork
     * @OneToOne(targetEntity="Paperwork", mappedBy="customer")
     */
    protected $paperwork;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Warranty", mappedBy="customer")
     */
    protected $warranties;

    public function __construct()
    {
        $this->warranties = new ArrayCollection();
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
     * @return Customer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
     * @return Customer
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
     * @return Customer
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
     * @return Customer
     */
    public function setWarranties($warranties)
    {
        $this->warranties = $warranties;
        return $this;
    }

    public function info(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }
}
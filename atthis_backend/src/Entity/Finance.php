<?php
/**
 * Created by PhpStorm.
 * User: wmxpy
 * Date: 17-7-12
 * Time: 下午9:23
 */

namespace Entity;
use Controller;

/**
 * @Entity
 * @Table(name="atthis_finance")
 */
class Finance
{
    /**
     * @var integer
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var Selling
     * @OneToOne(targetEntity="Selling", inversedBy="finance")
     */
    protected $selling;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="financeManager")
     */
    protected $manager;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="financeSeller")
     */
    protected $seller;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="financeAccounting")
     */
    protected $accounting;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $picture;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $URL;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="financeFinanceManager")
     */
    protected $financeManager;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $bankName;

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
     * @return Finance
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
     * @return Finance
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;
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
     * @return Finance
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
     * @return Finance
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
     * @return Finance
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     * @return Finance
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * @param string $URL
     * @return Finance
     */
    public function setURL($URL)
    {
        $this->URL = $URL;
        return $this;
    }

    /**
     * @return User
     */
    public function getFinanceManager()
    {
        return $this->financeManager;
    }

    /**
     * @param User $financeManager
     * @return Finance
     */
    public function setFinanceManager($financeManager)
    {
        $this->financeManager = $financeManager;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     * @return Finance
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
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
     * @return Finance
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
        $this->timeController->create('finance', $this->id, $this->stage, $stage, $changedBy);

        $this->stage = $stage;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'selling' => $this->selling->fixedinfo(),
            'manager' => $this->manager ? $this->manager->getFullName() : '',
            'seller' => $this->manager ? $this->manager->getFullName() : '',
            'accounting' => $this->manager ? $this->manager->getFullName() : '',
            'picture' => $this->picture,
            'URL' => $this->URL,
            'financeManager' => $this->financeManager ? $this->financeManager->getFullName() : '',
            'bankName' => $this->bankName,
            'stage' => $this->stage,
        ];
    }
}
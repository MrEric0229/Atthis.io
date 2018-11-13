<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity(repositoryClass="UserRepository")
* @Table(name="atthis_user")
*/
class User{

    /**
    * @var integer
    * @Column(type="integer")
    * @Id
    * @GeneratedValue
    */
    protected $id;

    /**
    * @var string
    * @Column(name="username", nullable=false)
    */
    protected $username;

    /**
    * @var string
    * @Column(nullable=false)
    */
    protected $password;

    /**
    * @var string
    * @Column(nullable=false)
    */
    protected $authority;

    /**
    * @var string
    * @Column(nullable=false)
    */
    protected $firstname;

    /**
    * @var string
    * @Column(nullable=false)
    */
    protected $lastname;

    /**
    * @var string
    * @Column(nullable=true)
    */
    protected $token = 'defaultToken';

    /**
    * @var Task[]
    * @OneToMany(targetEntity="Task", mappedBy="user")
    */
    protected $tasks;

    /**
     * @var TBuy[]
     * @OneToMany(targetEntity="TBuy", mappedBy="manager")
     */
    protected $TBuyManager;

    /**
     * @var TBuy[]
     * @OneToMany(targetEntity="TBuy", mappedBy="seller")
     */
    protected $TBuySeller;

    /**
     * @var TBuy[]
     * @OneToMany(targetEntity="TBuy", mappedBy="accounting")
     */
    protected $TBuyAccounting;

    /**
     * @var TBuy[]
     * @OneToMany(targetEntity="TBuy", mappedBy="frontDesk")
     */
    protected $TBuyFrontDesk;

    /**
     * @var Check[]
     * @OneToMany(targetEntity="Check", mappedBy="accounting")
     */
    protected $checks;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Notice", mappedBy="user")
     */
    protected $notices;

    /**
     * @var Freight
     * @OneToMany(targetEntity="Freight", mappedBy="manager")
     */
    protected $freightManager;

    /**
     * @var Freight
     * @OneToMany(targetEntity="Freight", mappedBy="frontDesk")
     */
    protected $freightFrontDesk;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Service", mappedBy="manager")
     */
    protected $serviceManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Service", mappedBy="accounting")
     */
    protected $serviceAccounting;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Service", mappedBy="serviceManager")
     */
    protected $serviceServiceManger;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Inventory", mappedBy="user")
     */
    protected $inventoryUser;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Detail", mappedBy="manager")
     */
    protected $detailManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Detail", mappedBy="detailManager")
     */
    protected $detailDetailManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Selling", mappedBy="manager")
     */
    protected $sellingManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Selling", mappedBy="accounting")
     */
    protected $sellingAccounting;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Selling", mappedBy="sales")
     */
    protected $sellingSales;

    /**
     * @var Finance
     * @OneToMany(targetEntity="Finance", mappedBy="seller")
     */
    protected $financeSeller;

    /**
     * @var Finance
     * @OneToMany(targetEntity="Finance", mappedBy="manager")
     */
    protected $financeManager;

    /**
     * @var Finance
     * @OneToMany(targetEntity="Finance", mappedBy="accounting")
     */
    protected $financeAccounting;

    /**
     * @var Finance
     * @OneToMany(targetEntity="Finance", mappedBy="financeManager")
     */
    protected $financeFinanceManager;

    /**
     * @var Paperwork
     * @OneToMany(targetEntity="Paperwork", mappedBy="frontDesk")
     */
    protected $paperworkFrontDesk;

    /**
     * @var Paperwork
     * @OneToMany(targetEntity="Paperwork", mappedBy="accounting")
     */
    protected $paperworkAccounting;

    /**
     * @var Paperwork
     * @OneToMany(targetEntity="Paperwork", mappedBy="manager")
     */
    protected $paperworkManager;

    /**
     * @var Paperwork
     * @OneToMany(targetEntity="Paperwork", mappedBy="seller")
     */
    protected $paperworkSeller;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Warranty", mappedBy="manager")
     */
    protected $warrantyManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="Warranty", mappedBy="seller")
     */
    protected $warrantySeller;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="TradeIn", mappedBy="manager")
     */
    protected $tradeInManager;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="TradeIn", mappedBy="seller")
     */
    protected $tradeInSeller;

    /**
     * @var ArrayCollection
     * @OneToMany(targetEntity="TradeIn", mappedBy="accounting")
     */
    protected $tradeInAccounting;

    public function  __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->TBuyManager = new ArrayCollection();
        $this->TBuySeller = new ArrayCollection();
        $this->TBuyAccounting = new ArrayCollection();
        $this->TBuyFrontDesk = new ArrayCollection();
        $this->checks = new ArrayCollection();
        $this->notices = new ArrayCollection();
        $this->serviceManager = new ArrayCollection();
        $this->serviceAccounting = new ArrayCollection();
        $this->serviceServiceManger = new ArrayCollection();
        $this->detailDetailManager = new ArrayCollection();
        $this->detailManager = new ArrayCollection();
        $this->sellingSeller = new ArrayCollection();
        $this->sellingManager = new ArrayCollection();
        $this->sellingAccounting = new ArrayCollection();
        $this->warrantyManager = new ArrayCollection();
        $this->warrantySeller = new ArrayCollection();
        $this->tradeInSeller = new ArrayCollection();
        $this->tradeInManager = new ArrayCollection();
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
    */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
    * @return string
    */
    public function getUsername()
    {
        return $this->username;
    }

    /**
    * @param string $userName
    */
    public function setUsername($userName)
    {
        $this->username = $userName;
    }

    /**
    * @return string
    */
    public function getPassword()
    {
        return $this->password;
    }

    /**
    * @param string $password
    */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
    * @return string
    */
    public function getAuthority()
    {
        return $this->authority;
    }

    /**
    * @param string $authority
    */
    public function setAuthority($authority)
    {
        $this->authority = $authority;
    }

    /**
    * @return string
    */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
    * @param string $firstname
    */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
    * @return string
    */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
    * @param string $lastname
    */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
    * @return string
    */
    public function getToken()
    {
        return $this->token;
    }

    /**
    * @param string $token
    */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return ArrayCollection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param Task[] $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return TBuy[]
     */
    public function getTBuyManager()
    {
        return $this->TBuyManager;
    }

    /**
     * @param TBuy[] $TBuyManagers
     */
    public function setTBuyManager($TBuyManagers)
    {
        if( is_array($TBuyManagers) ){
            $TBuyManagers = new ArrayCollection($TBuyManagers);

            foreach($TBuyManagers as $TBuyManager){
                $TBuyManager->setManager($this);
                $this->TBuyManager->add($TBuyManager);
            }

            foreach($this->TBuyManager as $TBuyManager)
            {
                if(!$TBuyManagers->contains($TBuyManager))
                {
                    $TBuyManager->setManager(null);
                    $this->TBuyManager->removeElement($TBuyManager);
                }
            }
        }
        else{
            $this->TBuyManager[] = $TBuyManagers;
            $TBuyManagers->setManager($this);
        }
    }

    /**
     * @return TBuy[]
     */
    public function getTBuySeller()
    {
        return $this->TBuySeller;
    }

    /**
     * @param TBuy[] $TBuySellers
     */
    public function setTBuySeller($TBuySellers)
    {
//        if( is_array($TBuySellers) ){
//            $TBuySellers = new ArrayCollection($TBuySellers);
//
//            foreach($TBuySellers as $TBuySeller){
//                $TBuySeller->setSeller($this);
//                $this->TBuySeller->add($TBuySeller);
//            }
//
//            foreach($this->TBuySeller as $TBuySeller)
//            {
//                if(!$TBuySellers->contains($TBuySeller))
//                {
//                    $TBuySeller->setSeller(null);
//                    $this->TBuySeller->removeElement($TBuySeller);
//                }
//            }
//        }
//        else{
//            $this->TBuySeller[] = $TBuySellers;
//            $TBuySellers->setSeller($this);
//        }
        $this->TBuySeller = $TBuySellers;
        return $this;
    }

    /**
     * @return TBuy[]
     */
    public function getTBuyAccounting()
    {
        return $this->TBuyAccounting;
    }

    /**
     * @param TBuy[] $TBuyAccountings
     */
    public function setTBuyAccounting($TBuyAccountings)
    {
        if( is_array($TBuyAccountings) ){
            $TBuyAccountings = new ArrayCollection($TBuyAccountings);

            foreach($TBuyAccountings as $TBuyAccounting){
                $TBuyAccounting->setAccounting($this);
                $this->TBuyAccounting->add($TBuyAccounting);
            }

            foreach($this->TBuyAccounting as $TBuyAccounting)
            {
                if(!$TBuyAccountings->contains($TBuyAccounting))
                {
                    $TBuyAccounting->setAccounting(null);
                    $this->TBuyAccounting->removeElement($TBuyAccounting);
                }
            }
        }
        else{
            $this->TBuyAccounting[] = $TBuyAccountings;
            $TBuyAccountings->setAccounting($this);
        }
    }

    /**
     * @return TBuy[]
     */
    public function getTBuyFrontDesk()
    {
        return $this->TBuyFrontDesk;
    }

    /**
     * @param TBuy[] $TBuyFrontDesks
     */
    public function setTBuyFrontDesk($TBuyFrontDesks)
    {
        if( is_array($TBuyFrontDesks) ){
            $TBuyFrontDesks = new ArrayCollection($TBuyFrontDesks);

            foreach($TBuyFrontDesks as $TBuyFrontDesk){
                $TBuyFrontDesk->setAccounting($this);
                $this->TBuyFrontDesk->add($TBuyFrontDesk);
            }

            foreach($this->TBuyFrontDesk as $TBuyFrontDesk)
            {
                if(!$TBuyFrontDesks->contains($TBuyFrontDesk))
                {
                    $TBuyFrontDesk->setAccounting(null);
                    $this->TBuyFrontDesk->removeElement($TBuyFrontDesk);
                }
            }
        }
        else{
            $this->TBuyFrontDesk[] = $TBuyFrontDesks;
            $TBuyFrontDesks->setAccounting($this);
        }
    }

    public function getFullName(){
        return $this->firstname." ".$this->lastname;
    }

    /**
     * @return Check[]
     */
    public function getChecks()
    {
        return $this->checks;
    }

    /**
     * @param Check $checks
     */
    public function setChecks($checks)
    {
        if( is_array($checks) ){
            $checks = new ArrayCollection($checks);

            foreach($checks as $check){
                $check->setSeller($this);
                $this->TBuySeller->add($check);
            }

            foreach($this->checks as $check)
            {
                if(!$checks->contains($check))
                {
                    $check->setSeller(null);
                    $this->checks->removeElement($check);
                }
            }
        }
        else{
            $this->checks[] = $checks;
            $checks->setAccounting($this);
        }
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
     * @return User
     */
    public function setNotices($notices)
    {
        $this->notices = $notices;
        return $this;
    }

    /**
     * @return Freight
     */
    public function getFreightManager()
    {
        return $this->freightManager;
    }

    /**
     * @param Freight $freightManager
     * @return User
     */
    public function setFreightManager($freightManager)
    {
        $this->freightManager = $freightManager;
        return $this;
    }

    /**
     * @return Freight
     */
    public function getFreightFrontDesk()
    {
        return $this->freightFrontDesk;
    }

    /**
     * @param Freight $freightFrontDesk
     * @return User
     */
    public function setFreightFrontDesk($freightFrontDesk)
    {
        $this->freightFrontDesk = $freightFrontDesk;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @param ArrayCollection $serviceManager
     * @return User
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServiceAccounting()
    {
        return $this->serviceAccounting;
    }

    /**
     * @param ArrayCollection $serviceAccounting
     * @return User
     */
    public function setServiceAccounting($serviceAccounting)
    {
        $this->serviceAccounting = $serviceAccounting;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServiceServiceManger()
    {
        return $this->serviceServiceManger;
    }

    /**
     * @param ArrayCollection $serviceServiceManger
     * @return User
     */
    public function setServiceServiceManger($serviceServiceManger)
    {
        $this->serviceServiceManger = $serviceServiceManger;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getInventoryUser()
    {
        return $this->inventoryUser;
    }

    /**
     * @param ArrayCollection $inventoryUser
     * @return User
     */
    public function setInventoryUser($inventoryUser)
    {
        $this->inventoryUser = $inventoryUser;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDetailManager()
    {
        return $this->detailManager;
    }

    /**
     * @param ArrayCollection $detailManager
     * @return User
     */
    public function setDetailManager($detailManager)
    {
        $this->detailManager = $detailManager;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDetailDetailManager()
    {
        return $this->detailDetailManager;
    }

    /**
     * @param ArrayCollection $detailDetailManager
     * @return User
     */
    public function setDetailDetailManager($detailDetailManager)
    {
        $this->detailDetailManager = $detailDetailManager;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSellingManager()
    {
        return $this->sellingManager;
    }

    /**
     * @param ArrayCollection $sellingManager
     * @return User
     */
    public function setSellingManager($sellingManager)
    {
        $this->sellingManager = $sellingManager;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSellingAccounting()
    {
        return $this->sellingAccounting;
    }

    /**
     * @param ArrayCollection $sellingAccounting
     * @return User
     */
    public function setSellingAccounting($sellingAccounting)
    {
        $this->sellingAccounting = $sellingAccounting;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSellingSeller()
    {
        return $this->sellingSeller;
    }

    /**
     * @param ArrayCollection $sellingSeller
     * @return User
     */
    public function setSellingSeller($sellingSeller)
    {
        $this->sellingSeller = $sellingSeller;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinanceSeller()
    {
        return $this->financeSeller;
    }

    /**
     * @param Finance $financeSeller
     * @return User
     */
    public function setFinanceSeller($financeSeller)
    {
        $this->financeSeller = $financeSeller;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinanceManager()
    {
        return $this->financeManager;
    }

    /**
     * @param Finance $financeManager
     * @return User
     */
    public function setFinanceManager($financeManager)
    {
        $this->financeManager = $financeManager;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinanceAccounting()
    {
        return $this->financeAccounting;
    }

    /**
     * @param Finance $financeAccounting
     * @return User
     */
    public function setFinanceAccounting($financeAccounting)
    {
        $this->financeAccounting = $financeAccounting;
        return $this;
    }

    /**
     * @return Finance
     */
    public function getFinanceFinanceManager()
    {
        return $this->financeFinanceManager;
    }

    /**
     * @param Finance $financeFinanceManager
     * @return User
     */
    public function setFinanceFinanceManager($financeFinanceManager)
    {
        $this->financeFinanceManager = $financeFinanceManager;
        return $this;
    }

    /**
     * @return Paperwork
     */
    public function getPaperworkFrontDesk()
    {
        return $this->paperworkFrontDesk;
    }

    /**
     * @param Paperwork $paperworkFrontDesk
     * @return User
     */
    public function setPaperworkFrontDesk($paperworkFrontDesk)
    {
        $this->paperworkFrontDesk = $paperworkFrontDesk;
        return $this;
    }

    /**
     * @return Paperwork
     */
    public function getPaperworkAccounting()
    {
        return $this->paperworkAccounting;
    }

    /**
     * @param Paperwork $paperworkAccounting
     * @return User
     */
    public function setPaperworkAccounting($paperworkAccounting)
    {
        $this->paperworkAccounting = $paperworkAccounting;
        return $this;
    }

    /**
     * @return Paperwork
     */
    public function getPaperworkManager()
    {
        return $this->paperworkManager;
    }

    /**
     * @param Paperwork $paperworkManager
     * @return User
     */
    public function setPaperworkManager($paperworkManager)
    {
        $this->paperworkManager = $paperworkManager;
        return $this;
    }

    /**
     * @return Paperwork
     */
    public function getPaperworkSeller()
    {
        return $this->paperworkSeller;
    }

    /**
     * @param Paperwork $paperworkSeller
     * @return User
     */
    public function setPaperworkSeller($paperworkSeller)
    {
        $this->paperworkSeller = $paperworkSeller;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getWarrantySeller()
    {
        return $this->warrantySeller;
    }

    /**
     * @param ArrayCollection $warrantySeller
     * @return User
     */
    public function setWarrantySeller($warrantySeller)
    {
        $this->warrantySeller = $warrantySeller;
        return $this;
    }


}
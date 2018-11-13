<?php

namespace Entity;

/**
 * Class Notice
 * @Entity
 * @Table(name="atthis_notice")
 */
class Notice
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
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $notice;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $getFrom;

    /**
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="notices")
     */
    protected $user;

    /**
     * @var TBuy
     * @ManyToOne(targetEntity="TBuy", inversedBy="notices")
     */
    protected $TBuy;

    /**
     * @var Service
     * @ManyToOne(targetEntity="Service", inversedBy="notices")
     */
    protected $service;

    /**
     * @var Detail
     * @ManyToOne(targetEntity="Detail", inversedBy="notices")
     */
    protected $detail;

    public function __construct()
    {
        $this->stage = '0';
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
     * @return Notice
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
     * @return Notice
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param string $notice
     * @return Notice
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
        return $this;
    }

    /**
     * @return string
     */
    public function getGetFrom()
    {
        return $this->getFrom;
    }

    /**
     * @param string $getFrom
     * @return Notice
     */
    public function setGetFrom($getFrom)
    {
        $this->getFrom = $getFrom;
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
     * @param User $user
     * @return Notice
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * @return Notice
     */
    public function setTBuy($TBuy)
    {
        $this->TBuy = $TBuy;
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
     * @return Notice
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
     * @return Notice
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    public function info(){
        return [
            'id' => $this->id,
            'from' => $this->getFrom,
            'notice' => $this->notice,
        ];
    }
}
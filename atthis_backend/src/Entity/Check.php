<?php

namespace Entity;

/**
 * Class Check
 * @Entity
 * @Table(name="atthis_check")
 */
class Check
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
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="checks")
     */
    protected $accounting;

    /**
     * @var TBuy
     * @OneToOne(targetEntity="TBuy", inversedBy="check")
     */
    protected $TBuy;

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
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
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
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;
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
     */
    public function setTBuy($TBuy)
    {
        $this->TBuy = $TBuy;
    }

    public function info(){
        return [
            'id' => $this->id,
            'checkNumber' => $this->TBuy->getCheckNumber(),
            'transferNumber' => $this->TBuy->getTransferNumber(),
            'transferTime' => $this->TBuy->getTransferTime(),
            'price' => $this->TBuy->getFinalPrice(),
        ];
    }
}
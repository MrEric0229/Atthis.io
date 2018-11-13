<?php
/**
 * Created by PhpStorm.
 * User: wmxpy
 * Date: 17-7-12
 * Time: 下午9:40
 */

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class Finance
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $selling Entity\Selling
     * @param $manager Entity\User
     * @param $seller Entity\User
     * @param $accounting Entity\User
     *
     * @return Entity\Finance
     */
    public function create($sellingId, $managerId, $sellerId, $accountingId, $financeId){
        $finance = new Entity\Finance();
        
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', $managerId);
        /** @var Entity\User $seller */
        $seller = $this->entityManager->find('Entity\\User', $sellerId);
        /** @var Entity\User $accounting */
        $accounting = $this->entityManager->find('Entity\\User', $accountingId);

        $finance->setStage('0')
            ->setManager($manager)
            ->setSeller($seller)
            ->setAccounting($accounting);

        $this->entityManager->persist($finance);
        $this->entityManager->flush();

        $this->createTime($seller, $finance);
        $this->createTask($seller, $finance);

        return $finance;
    }

    /**
     * @param $id
     *
     * @return Entity\Finance
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Finance', $id);
    }
}
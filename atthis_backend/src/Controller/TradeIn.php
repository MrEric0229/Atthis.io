<?php
/**
 * Created by PhpStorm.
 * User: wmxpy
 * Date: 17-8-14
 * Time: 下午10:36
 */

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class TradeIn
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
     * @param string $carId
     * @param string $sellerId
     * @param string $managerId
     * @param string $sellingId
     * @param string $accountingId
     *
     * @return Entity\TradeIn
     */
    public function create($carId, $sellerId, $managerId, $accountingId, $sellingId)
    {
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', (int) $carId);
        /** @var Entity\User $seller */
        $seller = $this->entityManager->find('Entity\\User', (int) $sellerId);
        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', (int) $managerId);
        /** @var Entity\User $accounting */
        $accounting = $this->entityManager->find('Entity\\User', (int) $accountingId);
        /** @var Entity\Selling $selling */
        $selling = $this->entityManager->find('Entity\\Selling', (int) $sellingId);

        /** @var Entity\TradeIn $tradeIn */
        $tradeIn = new Entity\TradeIn();

        $tradeIn->setStage('0')
            ->setCar($car)
            ->setManager($manager)
            ->setSeller($seller)
            ->setAccounting($accounting)
            ->setSelling($selling);

        $this->entityManager->persist($tradeIn);
        $this->entityManager->flush();

        $this->createTime($tradeIn);

        $this->createTask($manager, $tradeIn);
        $this->createTask($seller, $tradeIn);

        return $tradeIn;
    }

    /**
     * @param string $id
     * @return Entity\TradeIn
     */
    public function get($id){
        return $this->entityManager->find('Entity\\TradeIn', (int) $id);
    }

    /**
     * @param string $sellingId
     * @param string $tradeInId
     *
     * @return Entity\TradeIn
     */
    public function addSelling($sellingId, $tradeInId){
        /** @var Entity\TradeIn $tradeIn */
        $tradeIn = $this->get((int) $tradeInId);
        /** @var Entity\Selling $selling */
        $selling = $this->entityManager->find('Entity\\Selling', (int) $sellingId);

        $tradeIn->setSelling($selling);

        $this->entityManager->flush();

        return $tradeIn;
    }

    /**
     * @param Entity\TradeIn $tradeIn
     *
     * @return Entity\Time
     */
    private function createTime($tradeIn){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($tradeIn->getStage())
            ->setStageFrom('')
            ->setTask('tradeIn')
            ->setTaskId($tradeIn->getId())
            ->setChangedBy($tradeIn->getSeller()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\TradeIn $tradeIn
     *
     * @return Entity\Task
     */
    private function createTask($user, $tradeIn){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::TRADEIN))
            ->setTargetTaskId($tradeIn->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}

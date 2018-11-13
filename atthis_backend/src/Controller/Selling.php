<?php

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class Selling
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
     * Create new Selling entity
     *
     * @param string $managerId
     * @param string $accountingId
     * @param string $salesId
     * @param string $customerId
     * @param string $carId
     * @param string $stage
     * @param boolean $tradeIn
     * @param string $priceDrop
     * @param string $budget
     * @param string $vin1
     * @param string $vin2
     * @param string $vin3
     * @param string $url1
     * @param string $url2
     * @param string $url3
     * @param string $note
     * @param boolean $inventory
     *
     * @return Entity\Selling
     */
    public function create($managerId, $accountingId, $salesId, $customerId, $carId, $stage, $tradeIn, $priceDrop, $budget, $vin1, $vin2, $vin3, $url1, $url2, $url3, $note, $inventory){
        $selling = new Entity\Selling();

        /** @var Entity\User $manager */
        $manager = $this->entityManager->find('Entity\\User', (int) $managerId);
        /** @var Entity\User $accounting */
        $accounting = $this->entityManager->find('Entity\\User', (int) $accountingId);
        /** @var Entity\User $sales */
        $sales = $this->entityManager->find('Entity\\User', (int) $salesId);
        /** @var Entity\Customer $customer */
        $customer = $this->entityManager->find('Entity\\Customer', (int) $customerId);
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', (int) $carId);

        $selling->setStage($stage)
            ->setManager($manager)
            ->setAccounting($accounting)
            ->setSales($sales)
            ->setCustomer($customer)
            ->setTradeIn($tradeIn)
            ->setNote($note)
            ->setInventory($inventory);

        if ($stage==='I1'){
            $selling->setCar($car)
                ->setResourceType('Inventory');
        }
        elseif ($stage==='I1D'){
            $selling->setPriceDrop($priceDrop)
                ->setCar($car)
                ->setResourceType('Inventory');
        }
        elseif ($stage==='A1'){
            $selling->setBudget($budget)
                ->setVin1($vin1)
                ->setVin2($vin2)
                ->setVin3($vin3)
                ->setResourceType('Auction');
        }
        elseif ($stage==='W1'){
            $selling->setBudget($budget)
                ->setUrl1($url1)
                ->setUrl2($url2)
                ->setUrl3($url3)
                ->setResourceType('Wholesale');
        }


        $this->entityManager->persist($selling);
        $this->entityManager->flush();

        $this->createTime($selling);

        $this->createTask($manager, $selling);
        $this->createTask($accounting, $selling);
        $this->createTask($sales, $selling);

        return $selling;
    }

    /**
     * Add Freight to Selling
     *
     * @param $freightId
     * @param $sellingId
     *
     * @return Entity\Selling
     */
    public function addFreight($freightId, $sellingId){
        /** @var Entity\Freight $freight */
        $freight = $this->entityManager->find('Entity\\Freight', $freightId);
        /** @var Entity\Selling $selling */
        $selling = $this->entityManager->find('Entity\\Selling', $sellingId);

        $selling->setFreight($freight);

        $this->entityManager->flush();
        return $selling;
    }

    /**
     * Add Freight to Selling
     *
     * @param $freightId
     * @param $sellingId
     *
     * @return Entity\Selling
     */
    public function addFreightToCustomer($freightId, $sellingId){
        /** @var Entity\Freight $freight */
        $freight = $this->entityManager->find('Entity\\Freight', $freightId);
        /** @var Entity\Selling $selling */
        $selling = $this->entityManager->find('Entity\\Selling', $sellingId);

        $selling->setFreightToCustomer($freight);

        $this->entityManager->flush();
        return $selling;
    }

    /**
     * Add Finance to Selling
     *
     * @param $financeId
     * @param $sellingId
     *
     * @return Entity\Selling
     */
    public function addFinance($financeId, $sellingId){
        /** @var Entity\Finance $finance */
        $finance = $this->entityManager->find('Entity\\Finance', $financeId);
        /** @var Entity\Selling $selling */
        $selling = $this->entityManager->find('Entity\\Selling', $sellingId);

        $selling->setFinance($finance);
        $finance->setSelling($selling);

        $this->entityManager->flush();
        return $selling;
    }

    /**
     * @param $id
     * @return Entity\Selling
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Selling', $id);
    }

    /**
     * @param Entity\Selling $selling
     *
     * @return Entity\Time
     */
    private function createTime($selling){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage($selling->getStage())
            ->setStageFrom('')
            ->setTask('selling')
            ->setTaskId($selling->getId())
            ->setChangedBy($selling->getSales()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }

    /**
     * @param Entity\User $user
     * @param Entity\Selling $selling
     *
     * @return Entity\Task
     */
    private function createTask($user, $selling){
        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::SELLING))
            ->setTargetTaskId($selling->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }
}
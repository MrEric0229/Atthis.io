<?php

namespace Controller;

require_once __DIR__ . "/../Entity/Task.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Check
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Entity\User $accounting, Entity\TBuy $TBuy)
    {
        $check = new Entity\Check();

        $check->setStage('0');
        $check->setAccounting($accounting);
        $check->setTBuy($TBuy);

        $this->entityManager->persist($check);
        $this->entityManager->flush();

        return $check;
    }

    public function delete($id){
        $check = $this->entityManager->find('Entity\Check', $id);

        $this->entityManager->remove($check);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     * @return null|Entity\Check
     */
    public function get($id){
        return $this->entityManager->find('Entity\Check', $id);
    }

    /**
     * @param string $checkId
     * @return Entity\Time
     */
    public function update($checkId){
        /** @var Entity\Time $time */
        $time = new Entity\Time();
        /** @var Entity\Check $check */
        $check = $this->entityManager->find('Entity\\Check', (int) $checkId);

        $check->setStage('1');

        $time->setTask('check')
            ->setTaskId($checkId)
            ->setStage('1')
            ->setStageFrom('0')
            ->setChangedBy($check->getAccounting()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }
}
<?php

namespace Controller;

require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Inventory{
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
     * @param string $userId
     * @param string $price
     * @param boolean $consignment
     *
     * @return Entity\Inventory
     */
    public function create($carId, $userId, $price, $consignment){
        /** @var Entity\Inventory $inventory */
        $inventory = new Entity\Inventory();
        /** @var Entity\Car $car */
        $car = $this->entityManager->find('Entity\\Car', (int) $carId);
        /** @var Entity\User $user */
        $user = $this->entityManager->find('Entity\\User', (int) $userId);

        $inventory->setCar($car)
            ->setExist("1")
            ->setUser($user)
            ->setPrice($price)
            ->setConsignment($consignment);

        $this->entityManager->persist($inventory);
        $this->entityManager->flush();

        $this->createTime($inventory);

        return $inventory;
    }

    /**
     * @param $id
     *
     * @return Entity\Inventory
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Inventory', $id);
    }

    /**
     * @return array
     */
    public function getAll(){
        $inventories =  $this->entityManager->createQueryBuilder()
            ->select("i")
            ->from('Entity\\Inventory', 'i')
            ->getQuery()
            ->getResult();
        $data = [];

        /** @var Entity\Inventory $inventory */
        foreach ($inventories as $inventory){
            /** @var Entity\Car $car */
            $car = $inventory->getCar();
            $carInfo = [
                'make' => $car->getMake(),
                'model' => $car->getModel(),
                'year' => $car->getYear(),
                'vin' => $car->getVin(),
                'mileage' => $car->getMileage(),
                'exteriorColor' => $car->getExteriorColor(),
                'interiorColor' => $car->getInteriorColor(),
                'fuel' => $car->getFuel(),
                'engine' => $car->getEngine(),
                'transmission' => $car->getTransmission(),
                'driveType' => $car->getDriveType(),
                'bodyStyle' => $car->getBodyStyle(),
                'comments' => $car->getComments(),
                'pictures' => $car->getPicture(),
                'id' => $car->getId()
            ];
            array_push(
                $data,
                [
                    'id' => $inventory->getId(),
                    'carInfo' => $carInfo,
                    'creater' => $inventory->getUser()->getFullName(),
                    'price' => $inventory->getPrice(),
                    'exist' => $inventory->getExist(),
                    'consignment' => $inventory->isConsignment(),
                ]
            );
        }
        return $data;
    }

    /**
     * @param Entity\Inventory $inventory
     *
     * @return Entity\Time
     */
    private function createTime($inventory){
        $time = new Entity\Time();

        $time->setTime(new \DateTime(date('Y-m-d H:i:s')))
            ->setStage('1')
            ->setStageFrom('')
            ->setTask('Inventory')
            ->setTaskId($inventory->getId())
            ->setChangedBy($inventory->getUser()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();

        return $time;
    }
}
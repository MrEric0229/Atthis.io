<?php

namespace Controller;

require_once __DIR__ . "/../Entity/Car.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Car
{
    /**
     * @var EntityManager;
     */
    private $entityManager;

    public function __construct($entityManger)
    {
        $this->entityManager = $entityManger;
    }

    public function create($make, $model, $year, $vin, $mileage, $exteriorColor, $interiorColor, $fuel, $engine, $transmission, $driveType, $bodyStyle, $comments, $picture){

        return $this->handle(new Entity\Car(), $make, $model, $year, $vin, $mileage, $exteriorColor, $interiorColor, $fuel, $engine, $transmission, $driveType, $bodyStyle, $comments, $picture);
    }

    public function edit($id, $make, $model, $year, $vin, $mileage, $exteriorColor, $interiorColor, $fuel, $engine, $transmission, $driveType, $bodyStyle, $comments, $picture){

        return $this->handle($this->getCar($id), $make, $model, $year, $vin, $mileage, $exteriorColor, $interiorColor, $fuel, $engine, $transmission, $driveType, $bodyStyle, $comments, $picture);
    }

    public function delete($id){
        $car = $this->getCar($id);

        $this->entityManager->remove($car);
        $this->entityManager->flush();
    }

    private function handle(Entity\Car $car, $make, $model, $year, $vin, $mileage, $exteriorColor, $interiorColor, $fuel, $engine, $transmission, $driveType, $bodyStyle, $comments, $picture){
        $car->setMake($make);
        $car->setModel($model);
        $car->setMileage($mileage);
        $car->setYear($year);
        $car->setVin($vin);
        $car->setExteriorColor($exteriorColor);
        $car->setInteriorColor($interiorColor);
        $car->setFuel($fuel);
        $car->setEngine($engine);
        $car->setTransmission($transmission);
        $car->setDriveType($driveType);
        $car->setBodyStyle($bodyStyle);
        $car->setComments($comments);
        $car->setPicture($picture);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return $car;
    }

    public function get($id){
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from('Entity\Car','c')
            ->where('c.id='.$id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(){
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from('Entity\Car', 'c')
            ->getQuery()
            ->getArrayResult();
    }

    public function getSearchResult($key){
        $cars = $this->entityManager->createQueryBuilder()
        ->select('c')
        ->from('Entity\Car', 'c')
        ->where("c.vin LIKE '%".$key."%'")
        ->orWhere("c.model LIKE '%".$key."%'")
        ->orWhere("c.make LIKE '%".$key."%'")
        ->orWhere("c.bodyStyle LIKE '%".$key."%'")
        ->getQuery()
        ->getArrayResult();

        return $cars;
    }
}

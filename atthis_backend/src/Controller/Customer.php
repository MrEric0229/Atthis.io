<?php

namespace Controller;

use Entity;
use Doctrine\ORM\EntityManager;

class Customer
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($name, $email, $phone, $address){
        $customer = new Entity\Customer();

        $customer->setEmail($email)
            ->setName($name)
            ->setPhone($phone)
            ->setAddress($address);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        return $customer;
    }

    /**
     * @param $id
     * @return null|Entity\Customer
     */
    public function get($id){
        return $this->entityManager->find('Entity\\Customer', $id);
    }

    public function getAll(){
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from('Entity\Customer', 'c')
            ->getQuery()
            ->getArrayResult();
    }

    public function getSearchResult($key){
        $customer = $this->entityManager->createQueryBuilder()
        ->select('c')
        ->from('Entity\Customer', 'c')
        ->where("c.name LIKE '%".$key."%'")
        ->orWhere("c.email LIKE '%".$key."%'")
        ->orWhere("c.phone LIKE '%".$key."%'")
        ->getQuery()
        ->getArrayResult();

        return $customer;
    }
}
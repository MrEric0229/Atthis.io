<?php

namespace Controller;

require_once __DIR__ . "/../Entity/User.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class User
{
    /**
     * @var EntityManager;
     */
    private $entityManager;

    public function __construct( $entityManger )
    {
        $this->entityManager = $entityManger;
    }

    public function create($username, $password, $authority, $firstname, $lastname){
        $user = new Entity\User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setAuthority($authority);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function edit($id, $firstname, $lastname, $password){
        $user = $this->entityManager->find('Entity\\User', $id);

        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $password==='' ?  : $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;

    }

    public function changePassword($id, $password){
        $user = $this->entityManager->find('Entity\\User', $id);

        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function changeToken($id, $token){
        $user = $this->entityManager->find('Entity\\User', $id);

        $user->setToken($token);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function getSearchResult($key){
        $user = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from('Entity\User', 'u')
            ->where("u.username LIKE '%".$key."%'")
            ->orWhere("u.firstname LIKE '%".$key."%'")
            ->orWhere("u.lastname LIKE '%".$key."%'")
            ->getQuery()
            ->getArrayResult();

        for($i=0;$i<count($user);$i++){
            $usr = $this->entityManager->find('Entity\\User', $user[$i]["id"]);
            $user[$i]["sellingSeller"] = $usr->getSellingManager();
        }

        return $user;
    }

    public function loginWithPass($username, $password){

        $user = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from('Entity\User', 'u')
            ->where("u.username='".$username."'")
            ->getQuery()
            ->getOneOrNullResult();

        if( strcmp($user->getPassword(), $password)==0 )
            return $user;
        else
            return null;

    }
    
    public function loginWithToken($token){

        $user = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from('Entity\User', 'u')
            ->where("u.token='".$token."'")
            ->getQuery()
            ->getOneOrNullResult();

        if( $user!=null ){
            return $user;
        }
        else
            return null;
    }

    /**
     * @param $id
     * @return null|Entity\User
     */
    public function get($id){
        return $this->entityManager->find('Entity\\User', $id);
    }

    public function getCertainRoles($role){
        $users = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from('Entity\User', 'u')
            ->where("u.authority='$role'")
            ->getQuery()
            ->getResult();
        $data = [];

        foreach ($users as $user){
            array_push($data, [ 'id'=> $user->getId(), 'name' => $user->getFullName() ]);
        }

        return $data;
    }
}

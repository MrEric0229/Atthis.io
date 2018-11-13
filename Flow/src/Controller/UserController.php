<?php

require_once "/home/asdfghjkl00081/child/flow/bootstrap.php";

class UserController
{

    public function indexAction(){
        $dql = $dql = "SELECT u FROM User u ORDER BY id";
        global $entityManger;
        $query = $entityManger->createQuery($dql);
        $users = $query->getResult();
        return array(
            'users' => $users,
        );
    }

    public function createAction($username, $password, $authority, $superAdminUserName, $superAdminPassword){
        $dql = "SELECT u FROM User u WHERE u.authority='superAdmin'";
        global $entityManger;
        $query = $entityManger->creatQuery($dql);
        $superAdmin = $query->getResult();

        if($superAdmin->getUserName()===$superAdminUserName && $superAdmin->getPassword()===$superAdminPassword){
            $user = new User();
            $user->setUserName($username);
            $user->setPassword($password);
            $user->setAuthority($authority);

            $entityManger->persist($user);
            $entityManger->flush();

            return array(
                'status' => true,
                'user' => $user,
            );
        }
        return array(
            'status' => false,
        );
    }

    public function viewAction($id){

    }

    public function editAction($id){

    }

    public function deleteAction($id){

    }
}
<?php
require_once('config.php');
require_once "bootstrap.php";

class TaskController
{
    public function indexAction(){
        $tasks = $this->entity('Task')->findBy();
        return array(
            'tasks' => $tasks,
        );
    }

    public function createAction(){
        //$entityManager
    }

    public function viewAction($id){

    }

    public function editAction($id){

    }

    public function deleteAction($id){

    }

}
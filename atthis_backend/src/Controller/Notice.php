<?php

namespace Controller;

require_once __DIR__ . "/../Entity/Task.php";
require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\EntityManager;
use Entity;

class Notice
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
     * @param $msg string
     * @param $from string
     * @param $user Entity\User
     *
     * @return Entity\Notice
     */
    public function createNotice($msg, $from, $user){
        $notice = new Entity\Notice();

        $notice->setNotice($msg)
            ->setGetFrom($from)
            ->setUser($user);

        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param $msg string
     * @param $from string
     * @param $user Entity\User
     *
     * @return Entity\Notice
     */
    public function createNoticeAndTask($msg, $from, $user){
        $notice = $this->createNotice($msg, $from, $user);

        $task = new Entity\Task();

        $task->setUser($user)
            ->setTaskList($this->entityManager->find('Entity\\TaskList', Entity\TaskList::NOTICE))
            ->setTargetTaskId($notice->getId());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param $msg string
     * @param $user Entity\User
     * @param $from string
     * @param $TBuy Entity\TBuy
     *
     * @return Entity\Notice
     */
    public function create($msg, $from, $user, $TBuy){
        $notice = new Entity\Notice();

        $notice->setNotice($msg)
            ->setGetFrom($from)
            ->setUser($user)
            ->setTBuy($TBuy);

        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param $msg string
     * @param $user Entity\User
     * @param $from string
     * @param $service Entity\Service
     *
     * @return Entity\Notice
     */
    public function createServiceNotice($msg, $from, $user, $service){
        $notice = new Entity\Notice();

        $notice->setNotice($msg)
            ->setGetFrom($from)
            ->setUser($user)
            ->setService($service);

        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param $msg string
     * @param $user Entity\User
     * @param $from string
     * @param $detail Entity\Detail
     *
     * @return Entity\Notice
     */
    public function createDetailNotice($msg, $from, $user, $detail){
        $notice = new Entity\Notice();

        $notice->setNotice($msg)
            ->setGetFrom($from)
            ->setUser($user)
            ->setDetail($detail);

        $this->entityManager->persist($notice);
        $this->entityManager->flush();

        return $notice;
    }

    /**
     * @param string $id
     */
    public function delete($id){
        $notice = $this->get($id);

        $this->entityManager->remove($notice);
        $this->entityManager->flush();
    }

    /**
     * @param string $id
     */
    public function update($id){
        /** @var Entity\Notice $notice */
        $notice = $this->entityManager->find('Entity\Notice', (int) $id);
        /** @var Entity\Time $time */
        $time = new Entity\Time();

        $notice->setStage('1');

        $time->setTime(new \DateTime())
            ->setTask('notice')
            ->setTaskId($id)
            ->setStage('1')
            ->setStageFrom('0')
            ->setChangedBy($notice->getUser()->getFullName());

        $this->entityManager->persist($time);
        $this->entityManager->flush();
    }

    /**
     * @param $id
     *
     * @return null|Entity\Notice
     */
    public function get($id){
        return $this->entityManager->find('Entity\Notice', (int) $id);
    }
}
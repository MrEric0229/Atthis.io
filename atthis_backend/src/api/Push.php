<?php
header('Access-Control-Allow-Origin: *');
require __DIR__ . '/../../autoload.php';

use JPush\Client as JPush;

class push
{

    private $client;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $noticeController;

    /**
     * push constructor.
     * @param \Controller\Notice $noticeController
     */
    public function __construct($noticeController)
    {
        $this->app_key = '5b8497fcd134f3f89362ef06';
        $this->master_secret = '734aaf35f75a7dd9a2e3cd45';

        $client = new JPush($this->app_key, $this->master_secret);

        $this->client = $client;
        $this->noticeController = $noticeController;
    }

    /**
     * @param $msg
     * @param $name
     */
    public function push($msg, $name)
    {

        $push_payload = $this->client->push()
            ->setPlatform('all')
            ->addAlias($name)
            ->setNotificationAlert('ATTHIS')
            ->iosNotification($msg, [
                'sound' => 'default'
            ])
            ->androidNotification($msg)
            ->message('ATTHIS', [
                'title' => $msg,
                'content_type' => 'text'
            ]);
            //->send();

        try {
            $push_payload->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
        } catch (\JPush\Exceptions\APIRequestException $e) {
        }
    }

    /**
     * @param string $msg
     * @param \Entity\User $from
     * @param \Entity\User $to
     */
    public function pushWithNotice($msg, $from, $to)
    {
        $this->push($msg, $to->getToken());

        $this->noticeController->createNoticeAndTask($msg, $from->getFullName(), $to);
    }

    public function reset($name)
    {
        $push_payload = $this->client->push()
            ->setPlatform('all')
            ->addAlias($name)
            ->iosNotification('', [
                'sound' => 'default',
                'badge' => '0'
            ]);
        try {
            $push_payload->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
        } catch (\JPush\Exceptions\APIRequestException $e) {
        }
    }
}

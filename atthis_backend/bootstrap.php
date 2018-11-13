<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
require_once "src/Entity/User.php";
require_once "src/Controller/Car.php";
require_once "src/Controller/Task.php";
require_once "src/Controller/User.php";
require_once "src/Controller/TBuy.php";
require_once "src/Controller/TaskList.php";
require_once "src/general/tokenGenerator.php";
require_once "src/api/Push.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Entity"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'flowadmin2',
    'password' => 'flowadmin',
    'dbname' => 'miphaflow',
    'driverOptions' => array(
        PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/isu-its-mysql-ca-trust/ca-cert.pem',
    )
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$carController = new Controller\Car($entityManager);
$TBuyController = new Controller\TBuy($entityManager);
$taskListController = new \Controller\TaskList($entityManager);
$userController = new Controller\User($entityManager);
$taskController = new Controller\Task($entityManager);
$timeController = new Controller\Time($entityManager);
$checkController = new Controller\Check($entityManager);
$noticeController = new Controller\Notice($entityManager);
$freightController = new Controller\Freight($entityManager);
$serviceController = new Controller\Service($entityManager);
$detailController = new Controller\Detail($entityManager);
$inventoryController = new Controller\Inventory($entityManager);
$sellingController = new Controller\Selling($entityManager);
$customerController = new Controller\Customer($entityManager);
$financeController = new Controller\Finance($entityManager);
$paperworkController = new Controller\Paperwork($entityManager);
$warrantyController = new Controller\Warranty($entityManager);
$tradeInController = new Controller\TradeIn($entityManager);
$push = new Push($noticeController);
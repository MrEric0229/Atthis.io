<?php
require __DIR__ . '/../autoload.php';

use JPush\Client as JPush;

$app_key = '5b8497fcd134f3f89362ef06';
$master_secret = '734aaf35f75a7dd9a2e3cd45';
$registration_id = getenv('registration_id');

$client = new JPush($app_key, $master_secret);
<?php

$payload = json_encode([
    'aps' => [
        'alert' => $title,
        'sound' => 'default',
        'badge' => 1
    ]
]);

$inner =
    // Id of 1
    chr(1)
    // The length (32 bytes)
    . pack('n', 32)
    // Hex String of Device Token
    . pack('H*', $deviceToken)

    // Id of 2
    . chr(2)
    // Length of the payload
    . pack('n', strlen($payload))
    // Payload that we're sending
    . $payload

    // Id of 3
    . chr(3)
    // Length of integer is 4
    . pack('n', 4)
    // Pack notifier to length of 4
    . pack('N', 1111)

    // Id of 4
    . chr(4)
    // Length of 4
    . pack('n', 4)
    // Set expiration to 1 day from now
    . pack('N', time() + 86400)

    // Id of 5
    . chr(5)
    // Length of 1
    . pack('n', 1)
    // Send immediately
    . chr(10);

$notification =
    chr(2)
    . pack('N', strlen($inner))
    . $inner;

// devicetoken
$deviceToken = 'c2130f62279b7401212072e42a5970e9264f95baf5f4bf8a8bcbf41fd61e870c';
// 私钥密码，生成pem的时候输入的
$passphrase = 'atthis';
// 定制推送内容，有一点的格式要求，详情Apple文档
$message = array(
    'body'=>'Push Notification Test from PHP'
);
$body['aps'] = array(
    'alert' => $message,
    'sound' => 'default',
    'badge' => 100,
);
$body['type']=3;
$body['msg_type']=4;
$body['title']='PushNotificationTest';
$body['msg']='Push Notification Test from PHP Part 2';

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/asdfghjkl00081/child/flow/src/PHPPush.pem');//记得把生成的push.pem放在和这个php文件同一个目录
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
$fp = stream_socket_client(
//这里需要特别注意，一个是开发推送的沙箱环境，一个是发布推送的正式环境，deviceToken是不通用的
    //'ssl://gateway.sandbox.push.apple.com:2195', $err,
    'ssl://gateway.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
    exit("Failed to connect: $err $errstr" . PHP_EOL);
echo 'Connected to APNS' . PHP_EOL;

$payload = json_encode($body);
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
$result = fwrite($fp, $msg, strlen($msg));
if (!$result)
    echo 'Message not delivered' . PHP_EOL;
else
    echo 'Message successfully delivered' . PHP_EOL;
fclose($fp);
?>
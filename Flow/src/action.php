<?php
header('Access-Control-Allow-Origin: *');

require 'connection.php';
require 'push.php';

$mode = $_POST['mode'];
switch ($mode) {

//    case "Officer1IndexAction":
//        $id = $_POST['id'];
//        echo Officer1IndexAction($conn, $id);
//        break;
//    case "Officer2IndexAction":
//        $id = $_POST['id'];
//        echo Officer2IndexAction($conn, $id);
//        break;

    //Create new task
    case "createTask":
        $officer1   = $_POST['officer1'];
        $officer2   = $_POST['officer2'];
        $seller     = $_POST['seller'];
        $carInfo   = $_POST['carInfo'];
        $vin        = $_POST['vin'];
        $stage1Note = $_POST['note'];
        //echo json_encode( var_dump($_POST) );
        echo createTask($conn, $officer1, $officer2, $seller, $carInfo, $vin, $stage1Note);
        break;

    //Action from seller (officer 1)
    case "Officer1Action":
        $officerId  = $_POST['id'];
        $taskId     = $_POST['taskId'];
        $stage1Note = $_POST['note'];
        $action     = $_POST['action'];
        $seller     = $_POST['seller'];
        $carInfo     = $_POST['carInfo'];
        $vin     = $_POST['vin'];
        echo Officer1Action($conn, $officerId, $taskId, $stage1Note, $action, $seller, $carInfo, $vin);
        break;

    //Action from accounting (officer 2)
    case "Officer2Action":
        $officerId  = $_POST['id'];
        $taskId     = $_POST['taskId'];
        $stage2Note = $_POST['note'];
        $action     = $_POST['action'];
        echo Officer2Action($conn, $officerId, $taskId, $stage2Note, $action);
        break;

    //Close a task
    case "closeTask":
        $taskId = $_POST['taskId'];
        echo closeTask($conn, $taskId);
        break;

    //Get all users
    case "UserIndexAction":
        echo UserIndexAction($conn);
        break;

    //Get all seller users
    case "SellerIndexAction":
        echo SellerIndexAction($conn);
        break;

    //Get all accounting users
    case "AccountingIndexAction":
        echo AccountingIndexAction($conn);
        break;

    //Edit user information
    case "EditAction":
        $id        = $_POST['id'];
        $password  = $_POST['password'];
        $authority = $_POST['authority'];
        $firstname = $_POST['firstname'];
        $lastname  = $_POST['lastname'];
        echo EditAction($conn, $id, $password, $authority, $firstname, $lastname);
        break;

    //Get all roles
    case "RoleIndexAction":
        echo RoleIndexAction($conn);
        break;

    //Get all tasks belong to certain user
    case "getTask":
        $id = $_POST['id'];
        $auth = $_POST['authority'];
        echo getTask($conn, $id, $auth);
        break;

    //Get all tasks
    case "getAllTask":
        $id = $_POST['id'];
        echo getAllTask($conn, $id);
        break;

    //Get notes for a certain task
    case "getNote":
        $id = $_POST['id'];
        $taskId = $_POST['taskId'];
        echo getNote($conn, $id, $taskId);
        break;

    //Helper method to send notification
    case "sendPushNotification":
        $id = $_POST['id'];
        echo sendPushNotification($conn, 'Test Notification', $id);
        break;

    default:
        echo json_encode("NO action found");
}

function sendPushNotification($conn, $msg, $id){
    $getToken = "SELECT token FROM user WHERE id=$id";
    $token = $conn->query($getToken)->fetch_assoc()['token'];
    $push = new push();
    $push->push($msg,$token);
}

/**
 * Get all roles.
 *
 * @param $conn
 * @return string
 */
function RoleIndexAction($conn){
    $data = array();
    $sql = "SELECT * FROM role";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            array_push($data, $row);
        }
    }
    return json_encode($data);
}

/**
 * Get all users.
 *
 * @param $conn
 * @return string
 */
function UserIndexAction($conn){
    $data = array();
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            array_push($data, $row);
        }
    }
    return json_encode($data);
}

/**
 * Get all seller users.
 *
 * @param $conn
 * @return string
 */
function SellerIndexAction($conn){
    $data = array();
    $sql = "SELECT * FROM user where authority='seller'";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            array_push($data, $row);
        }
    }
    return json_encode($data);
}

/**
 * Get all accounting users.
 *
 * @param $conn
 * @return string
 */
function AccountingIndexAction($conn){
    $data = array();
    $sql = "SELECT * FROM user where authority='accounting'";
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            array_push($data, $row);
        }
    }
    return json_encode($data);
}

/**
 * Get all tasks belongs to certain user.
 *
 * @param $conn
 * @param $id
 * @param $auth
 * @return string
 */
function getTask($conn, $id, $auth){
    switch ($auth){
        case "seller":
            $sql = "SELECT task.*, user.firstname, lastname
                    FROM task
                    LEFT JOIN user 
                    ON user.id=task.stage2Officer_id
                    WHERE stage1Officer_id=$id 
                    AND status='open'
                    AND (stage=2 OR stage=3)";
            //return toArray($conn, $sql);
            return toArrayWithNote($conn, $sql);
            break;
        case "accounting":
            $sql = "SELECT task.*, user.lastname, user.firstname 
                    FROM task 
                    LEFT JOIN user 
                    ON user.id=task.stage1Officer_id
                    WHERE stage2Officer_id=$id 
                    AND status='open'
                    AND (stage=0 OR stage=1)";
            return toArrayWithNote($conn, $sql);
            break;
        default:
            return json_encode("Error");
    }
}

/**
 * Get all task belongs to certain user including closed tasks.
 *
 * @param $conn
 * @param $id
 * @return string
 */
function getAllTask($conn, $id){
    $sql = "SELECT * 
            FROM task
            WHERE stage1Officer_id=$id
            OR    stage2Officer_id=$id
            OR    stage3Officer_id=$id";
    return toArray($conn, $sql);
}

////index all task
//function Officer1IndexAction($conn, $id){
//    $data = array();
//    $sql = "SELECT * FROM task WHERE stage1Officer_id=$id AND status='open' AND (stage=2 OR stage=3)";
//    $result = $conn->query($sql);
//    if( $result->num_rows > 0 ){
//        while( $row = $result->fetch_assoc() ){
//            array_push($data, $row);
//        }
//    }
//    //return json_encode($data);
//    return json_encode($data);;
//}
//
//function Officer2IndexAction($conn, $id){
//    $data = array();
//    $sql = "SELECT * FROM task WHERE stage2Officer_id=$id AND status='open' AND (stage=0 OR stage=1)";
//    $result = $conn->query($sql);
//    if( $result->num_rows > 0 ){
//        while( $row = $result->fetch_assoc() ){
//            array_push($data, $row);
//        }
//    }
//    return json_encode($data);
//}

/**
 * Create a new task
 *
 * @param $conn
 * @param $officer1
 * @param $officer2
 * @param $seller
 * @param $carInfo
 * @param $vin
 * @param $stage1Note
 * @return string
 */
function createTask($conn, $officer1, $officer2, $seller, $carInfo, $vin, $stage1Note){
    date_default_timezone_set("America/Chicago");
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO task(seller, car_info, vin, stage, date_created, status, stage1Officer_id, stage2Officer_id)
            VALUE('$seller', '$carInfo', '$vin', '0', '$date', 'open', $officer1, $officer2)";
    if( $conn->query($sql) ){
        $sql = "SELECT last_insert_id() FROM task";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id = $row['last_insert_id()'];
        $sql = "INSERT INTO note(msg, officer_id, task_id, stage)
                VALUES('$stage1Note', $officer1, $id, '0')";

        sendPushNotification($conn, 'You have a new task!', $officer2);
        return json_encode($conn->query($sql));
    }

    return json_encode(false);
}

/**
 * Action from seller (officer 1)
 *
 * @param $conn
 * @param $officerId
 * @param $taskId
 * @param $stage1Note
 * @param $action
 * @return string
 */
function Officer1Action($conn, $officerId, $taskId, $stage1Note, $action, $seller, $carInfo, $vin){
    date_default_timezone_set("America/Chicago");
    $date = date("Y-m-d H:i:s");

    switch($action){
        case "submit":
            $sql = "UPDATE task
            SET stage1Created='$date',
                stage='1',
                seller = '$seller',
                car_info = '$carInfo',
                vin = '$vin'
            WHERE id=$taskId";
            $sql2 = "INSERT INTO note(msg, officer_id, task_id, stage)
             VALUES('$stage1Note', $officerId, $taskId, '1')";

            $getResult = "SELECT task.stage2Officer_id, user.firstname, user.lastname 
                          FROM task
                          INNER JOIN user 
                          ON user.id=$officerId
                          WHERE task.id=$taskId";
            $result = $conn->query($getResult)->fetch_assoc();
            $msg = sprintf("%s %s has updated a task!", $result['firstname'], $result['lastname']);
            sendPushNotification($conn, $msg, $result['stage2Officer_id']);

            return json_encode($conn->query($sql) && $conn->query($sql2));
            break;
        case "done":
            $sql = "UPDATE task
                    SET closeTime='$date',
                        stage='4',
                        status = 'closed'
                    WHERE id=$taskId";
            return json_encode($conn->query($sql));
            break;
    }


}

/**
 * Action from accounting (officer 2)
 *
 * @param $conn
 * @param $officerId
 * @param $taskId
 * @param $stage2Note
 * @param $action
 * @return string
 */
function Officer2Action($conn, $officerId, $taskId, $stage2Note, $action){
    strcmp($action, "accept")==0 ? $status = '3' : $status = '2';
    date_default_timezone_set("America/Chicago");
    $date = date("Y-m-d H:i:s");

    $sql = "UPDATE task
            SET stage2Created='$date',
                stage='$status'
            WHERE id=$taskId";
    $sql2 = "INSERT INTO note(msg, officer_id, task_id, stage)
             VALUES('$stage2Note', $officerId, $taskId, '$status')";

    $officerId = (int) $officerId;
    $taskId = (int) $taskId;
    $getResult = "SELECT task.stage1Officer_id, user.firstname, user.lastname 
                  FROM task
                  INNER JOIN user 
                  ON user.id=$officerId
                  WHERE task.id=$taskId";
//    var_dump($officerId);
//    var_dump($taskId);
//    var_dump($conn->query($getResult));
    $result = $conn->query($getResult)->fetch_assoc();
//    var_dump($result);
    $msg = sprintf("%s %s has %sed your task!", $result['firstname'], $result['lastname'], $action);
    sendPushNotification($conn, $msg, $result['stage1Officer_id']);

    return json_encode($conn->query($sql) && $conn->query($sql2));
}

/**
 * Edit user information
 *
 * @param $conn
 * @param $id
 * @param $password
 * @param $authority
 * @param $firstname
 * @param $lastname
 * @return string
 */
function EditAction($conn, $id, $password, $authority, $firstname, $lastname){
    if( strcmp($password, "")==0 ){
        $sql = "UPDATE user
                SET authority='$authority',
                    firstname='$firstname',
                    lastname='$lastname'
                WHERE id=$id";
    }
    else{
        $sql = "UPDATE user
                SET password ='$password',
                    authority='$authority',
                    firstname='$firstname',
                    lastname='$lastname'
                WHERE id=$id";
    }

    return json_encode($conn->query($sql));
}

/**
 * Close a task
 *
 * @param $conn
 * @param $taskId
 * @return string
 */
function closeTask($conn, $taskId){
    $date = date("Y-m-d H:i:s");
    $sql = "UPDATE task
            SET status='closed',
                closeTime='$date'
            WHERE id=$taskId";
    return json_encode($conn->query($sql));
}

/**
 * Convert result from database to array
 *
 * @param $conn
 * @param $sql
 * @return string
 */
function toArray($conn, $sql){
    $data = array();
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            array_push($data, $row);
        }
    }
    return json_encode($data);
}

function toArrayWithNote($conn, $sql){
    $data = array();
    $result = $conn->query($sql);
    if( $result->num_rows > 0 ){
        while( $row = $result->fetch_assoc() ){
            //array_push($data, $row);
            $task_id = $row['id'];
            $getNote = "SELECT note.msg, note.stage, user.firstname, user.lastname 
                        FROM note 
                        INNER JOIN user 
                        ON user.id=note.officer_id 
                        WHERE task_id=$task_id
                        GROUP BY note.id";
            $notes = json_decode(toArray($conn, $getNote));
            $row['notes'] = $notes;
            array_push($data,$row);
        }
    }
    return json_encode($data);
}

/**
 * Get all notes for a single task
 *
 * @param $conn
 * @param $id
 * @param $taskId
 * @return string
 */
function getNote($conn, $id, $taskId){
    $sql = "SELECT * FROM note WHERE officer_id=$id AND task_id=$taskId";
    return toArray($conn, $sql);
}
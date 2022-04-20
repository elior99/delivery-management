<?php

session_start();
include("config.php");

header("Content-Type: application/json; charset=UTF-8");

$date = gmdate('Y-m-d H:i:s',strtotime('+ 3 hours'));


header('Access-Control-Allow-Origin: http://127.0.0.1:8000');
header("Access-Control-Allow-Credentials: true");


if(isset($_GET['save_order'])) {

    $raw = json_decode(file_get_contents('php://input'),true);
    
    $address = $raw['address'];
    $price = $raw['price'];
    $paid = $raw['paid'];
    $note = $raw['note'];
    $user_id = json_decode($_COOKIE['username'],true);
    $status = 1; // status=Pending


    $stmt = $conn->prepare("INSERT INTO `orders` (`user_id`,`address`,`price`,`paid`,`note`,`date`) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("isdiss",$user_id['id'],$address,$price,$paid,$note,$date);
    $stmt->execute();


}
else if(isset($_GET['login'])) {

    $raw = json_decode(file_get_contents('php://input'),true);
    
    $username = $raw['username'];
    $password = $raw['password'];
    $type = $raw['type'];

    $json['status'] = "error";

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` =? AND `password` =?  AND `type` = ?");
    $stmt->bind_param("ssi",$username,$password,$type);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    if ($result->num_rows > 0) {

        $json['status'] = "ok";
        $raw['id'] = $user['id'];
        setcookie("username", json_encode($raw,true), time()+31556926,"/");
    }
       

    echo json_encode($json,true);
}

else if(isset($_GET['getOrders'])) {

    $i = 0;
    $user_det = $_COOKIE['username'];
    $content = json_decode($user_det,true);

    $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `user_id` = ?");
    $stmt->bind_param("i",$content['id']);
    $stmt->execute();
  

    $result = $stmt->get_result();

     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row['status'] == 1)
                $type = "pending";
            else if($row['status'] == 2)
                $type = "proccess";
            else if($row['status'] == 3)
                $type = "completed";

            $json[$type][] = array("id" => $row['id'],"address" => $row['address'],"price" => $row['price'],"paid" => $row['paid'],"note" => $row['note'],
                                    "date" => $row['date'],"status" => $row['status']);



        }
    }

    else
        $json['status'] = "error";
        
    
    echo json_encode($json,true);


}

else if(isset($_GET['CourOrders'])) {

      $i = 0;
    $user_det = $_COOKIE['username'];
    $content = json_decode($user_det,true);

    $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `handled_by` = ? OR `status` = '1'");
    $stmt->bind_param("i",$content['id']);
    $stmt->execute();;

    $result = $stmt->get_result();

     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if($row['status'] == 1)
                $type = "pending";

            else if(($row['handled_by'] == $content['id']) & $row['status'] == 2) 
                    $type = "proccessing";
            
            else if(($row['handled_by'] == $content['id']) && $row['status'] == 3)
                    $type = "completed";
            

            $json[$type][] = array("id" => $row['id'],"address" => $row['address'],"price" => $row['price'],"paid" => $row['paid'],"note" => $row['note'],
                                    "date" => $row['date'],"handled_by" =>$row['handled_by']);


        }
    }

    else
        $json['status'] = "error";
        
    
    echo json_encode($json,true);



}



else if(isset($_GET['takeDel'])) {


    $raw = json_decode(file_get_contents('php://input'),true);
    
    $orderID = $raw['id'];

    echo $orderID;

    $user_det = $_COOKIE['username'];
    $content = json_decode($user_det,true);

    $stmt = $conn->prepare("UPDATE `orders` SET `status` = 2 , `handled_by` = ? WHERE `id` = ?");
    $stmt->bind_param("ii",$content['id'],$orderID);
    $stmt->execute();


}

else if(isset($_GET['completeOrder'])) {


    $raw = json_decode(file_get_contents('php://input'),true);
    
    $orderID = $raw['id'];

    echo $orderID;

    $user_det = $_COOKIE['username'];
    $content = json_decode($user_det,true);

    $stmt = $conn->prepare("UPDATE `orders` SET `status` = 3  WHERE `id` = ?");
    $stmt->bind_param("i",$orderID);
    $stmt->execute();


}

?>
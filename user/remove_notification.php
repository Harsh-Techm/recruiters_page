<?php
if(!isset($_SESSION)){
    // Start Session it is not started yet
    session_start();
  }
  if(!isset($_SESSION['login']) || $_SESSION['login']!=true)
  {
    header('location:../index.php');
    exit;
  }
  include 'fetch_data.php';
  $userId=$_SESSION['UserId'];

$data = json_decode(file_get_contents('php://input'),true);
$notificationId = $data['id'];

$sql = "UPDATE `userprojectdetails` SET `Send_Notification` = '0' WHERE `userprojectdetails`.`SlNo` = $notificationId";

if($conn->query($sql)===TRUE){
    echo json_encode(['success'=>true]);
}else{
    echo json_encode(['success'=>false]);
}
?>
<?php
// $conn = new mysqli("localhost","root","","recruitmentpage");

// if($conn->connect_error){
//     die("connection failed: ". $conn->connect_error);
// }

// $userId = 2;
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

//Fetch notifications
$sql = "SELECT upd.SLNo as id, CASE WHEN upd.Status = 'confirm' THEN CONCAT('You are confirmed by the agent ', u.UserName, ' for ', p.ProjectName) WHEN upd.Status = 'softlock' THEN CONCAT('You are softlocked by the agent ', u.UserName, ' for ', p.ProjectName) END as message FROM userprojectdetails upd JOIN users u ON upd.AgentId = u.UserId JOIN project p ON upd.ProjectId = p.ProjectId WHERE upd.UserId = $userId AND (upd.Status = 'confirm' OR upd.Status = 'softlock')";
    

$result = $conn->query($sql);

$notifications = [];
while($row = $result->fetch_assoc()){
    $notifications[] = $row;
}

echo json_encode(['notifications' => $notifications]);

?>
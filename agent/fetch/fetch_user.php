<?php
include ('../../database/dbconnect.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data=json_decode(file_get_contents("php://input"),true);
$userId = $data["userId"];

$sql = "SELECT ud.FirstName, ud.LastName, ud.About, ud.Age, ud.Gender, ud.Email, ud.HighestQualification, sm.SkillName, lm.LocationName, ud.Image, ud.Resume
from Userdetails ud 
join locationmaster lm on lm.LocationId=ud.Location 
join userskilldetails usd on usd.UserId=ud.UserId
join SkillMaster sm on sm.SkillId=usd.SkillId 
where usd.SkillType='Primary' and ud.UserId='$userId';";
// var_dump($sql);
$result = $conn->query($sql);

$user= $result->fetch_assoc();
if($user){
    if($user["Image"]){
        $user["image"]=base64_encode($user["Image"]);
    }
    else{
        $user["image"]=null;
    }

    if($user["Resume"]){
        $user["resume"]=base64_encode($user["Resume"]);
    }
    else{
        $user["resume"]=null;
    }

    unset($user["Image"]);
    unset($user["Resume"]);

    header('Content-Type: application/json');
    echo json_encode($user);
}
else{
    echo json_encode([]);
}

$conn->close();

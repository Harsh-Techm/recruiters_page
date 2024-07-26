<?php
 
session_start();
if(!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin']!=true)
{
    header('location:../index.php');
    exit;
}
include "../database/dbconnect.php";
 


// $user_name =  $_SESSION["UserName"];
 
$UserId = $_COOKIE['AgentId'];
$search_query = "SELECT * FROM `users` WHERE `UserId` LIKE '$UserId';";
$result = mysqli_query($conn, $search_query);
$row = $result->fetch_assoc();
// print_r($row);
// echo var_dump($row);
 
 
 
//                       Update agent profile code starts

if(isset($_POST['update'])){
    print_r($_POST);
    $user_name = $_POST['user_name'];
    // $last_name = $_POST['agent_last_name'];
    $email = $_POST['agent_email'];
    $phone = $_POST['agent_phone'];
    // $organisation = $_POST['agent_organisation'];
 
 
    $update_query = "UPDATE `users` SET `UserName` = '$user_name', `Phone` = '$phone' WHERE `Email` = '$email'";
   
   
    $result = mysqli_query($conn,$update_query);
   
    if(!$result){
        die("Unable to run update query ". mysqli_error($conn));
    }
    else{
        header("Refresh:0");
        // echo "Updated";
    }
}
 
 
 
 
?>
 
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <link type ="image/png" sizes ="96x96" rel ="icon" href =".../icons8-hamburger-96.png" >
    <link rel="stylesheet" href="styles/agent_profile.css">
   
</head>
<!-- <body style="background-image: url('../images/p (1).jpg'); background-size: cover;  color: black; font-size : 20px;">
    <div class="navbar">
        <div class="navbar-brand">Tech <br> <span style="color: red;">HireHub</span></div>
        <div class="dropdown">
            <button class="dropbtn" >
            <img src="../images/hamburger_icon.png" alt="Menu">
        </button>
            <div class="dropdown-content" style="right:0px;">
                <a href="index.php">Dashboard</a>
                <a href="agent_logout.php">Logout</a>
            </div>
        </div>
    </div>
 
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">👤</div>
            <div class="profile-title">Hi, <?php  //echo $row['UserName'] ?></div>
        </div>
        <form class="profile-form" action="agent_profile.php" method="post">

            <div class="form-group">
                <label for="user_name">Full name:</label>
                <input name="user_name" type="text" id="user_name" value= <?php //echo $row['UserName'];  ?>  readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('user_name')">✏️</button>
            </div>

            <div class="form-group-email">
                <label for="email">Email ID:</label>
                <input name="agent_email" type="email" id="email" value= <?php //echo $row['Email'];  ?> readonly>
            </div>

            <div class="form-group">
                <label for="phone">Phone no:</label>
                <input name="agent_phone" type="tel" id="phone" value= <?php //echo $row['Phone'];  ?> readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('phone')">✏️</button>
            </div>

 
            <div class="center-div">
                <input type="submit" name="update" value="Update" class="update-btn" style="border-radius:10px" id="agent-profile-update-btn">
            </div>
           
        </form>
    </div>
 
    <script src="script/agent_profile.js"></script>
</body> -->

<body style="background-image: url('../images/p (1).jpg'); background-size: cover;  color: black; font-size : 20px;">
    <div  style="background: transparent;"  class="navbar">
        <div class="navbar-brand">Tech <br> <span style="color: red;">HireHub</span></div>
        <div class="dropdown">
            <button  style="background: transparent;"  class="dropbtn" >
            <img src="../images/hamburger_icon.png" alt="Menu">
        </button>
            <div class="dropdown-content" style="right:0px;">
                <a href="index.php">Dashboard</a>
                <a href="agent_logout.php">Logout</a>
            </div>
        </div>
    </div>
 
    <div  style="background: transparent; color:white; border: 2px solid skyblue; backdrop-filter: blur(20px);" class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">👤</div>
            <div class="profile-title">Hi, <?php  echo $row['UserName'] ?></div>
        </div>
        <form class="profile-form" action="agent_profile.php" method="post">

            <div class="form-group">
                <label for="user_name">Full name:</label>
                <input  style="background: transparent; color:white;"  name="user_name" type="text" id="user_name" value= <?php echo $row['UserName'];  ?>  readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('user_name')">✏️</button>
            </div>

            <div class="form-group-email">
                <label for="email">Email ID:</label>
                <input  style="background: transparent; color:white; left: -20px; position:relative" name="agent_email" type="email" id="email" value= <?php echo $row['Email'];  ?> readonly>
            </div>

            <div class="form-group">
                <label for="phone">Phone no:</label>
                <input  style="background: transparent; color:white;" name="agent_phone" type="tel" id="phone" value= <?php echo $row['Phone'];  ?> readonly>
                <button type="button" class="edit-btn" onclick="toggleEdit('phone')">✏️</button>
            </div>

 
            <div class="center-div">
                <input  style="background: transparent; border-radius: 10px;" type="submit" name="update" value="Update" class="update-btn" style="border-radius:10px" id="agent-profile-update-btn">
            </div>
           
        </form>
    </div>
 
    <script src="script/agent_profile.js"></script>
</body>
</html>
 
<?php
 
 
?>
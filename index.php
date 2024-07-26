<?php
include "partials/_login_header.php";

//riju dasgupta

include "database/config.php";
if (isset($_POST["user_login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];

    $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$connection) {
        echo "Something went wrong";
    }
    $sql = "SELECT * FROM `Users` WHERE Email LIKE '$email' AND Type LIKE '$type'";
    $result = mysqli_query($connection, $sql);

    $row = $result->fetch_assoc();
     
    if ($result) {
        if ($password == $row['Password']) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['UserId']= $row['UserId'];

            $sqlid = "SELECT * FROM `userdetails` WHERE Email='$email'";
            $result1 = mysqli_query($connection,$sqlid);
            if($result1->num_rows > 0){
                header("location:user/landing.php");
               
            }else{
                header("location:user/fill_data.php");
            }
            
        } else {
            echo"<link rel='stylesheet' href='login_index.css'>
            <h1 class='popup1'>Email/Password not matched !</h1>";

        }
    } else {
        echo "Connection failed";
    }



} else if (isset($_POST["agent_login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];

    $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');
    if (!$connection) {
        echo "Something went wrong";
    }
    $sql = "SELECT * FROM `Users` WHERE Email LIKE '$email' AND Type LIKE '$type'";
    // var_dump($sql);
    $result = mysqli_query($connection, $sql);
    $row = $result->fetch_assoc();
    // var_dump($row);
       
    

    if ($result) {
        if ($password == $row['Password']) {
            session_start();
            $_SESSION['agentLogin'] = true;
            
            $expiry=time()+(3600*24);
            // $path=
            setcookie("AgentId",$row['UserId'],$expiry);
            // echo "<h1>welcome to recruitment_portal</h1>";
            header("location:agent/index.php");
        } else {
            // echo "<h1>Password do not match</h1>";
            echo"<link rel='stylesheet' href='login_index.css'>
            <h1 class='popup1'>Email/Password not matched !</h1>";

        }
    } else {
        echo "Connection failed";
    }



}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <link rel="stylesheet" href="login_index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <!-- <div class="container">
        <div id="user-login-box" class="login-box">
            
            
            <h1>User Login</h1>
            <form action="index.php" method="post">
                <div></div>
                <input type="text" name="email" placeholder="Email Id" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="hidden" id="Type" name="Type" value="User">
                <button type="submit" name="user_login" class="login-btn">LOGIN</button>
                <a href="reset_password_user.php" class="forgot-password">Forgot password?</a>
                <a href="user_registration.php"> <button type="button" class="register-btn">REGISTER</button></a>
            </form>
        </div>
        <div id="agent-login-box" class="login-box" style="display: none;">
            
            <img src="images\agent-logo.png" width="100" height="100">
            <h2>AGENT LOGIN</h2>
            <form action="index.php" method="post">
                <input type="text" name="email" placeholder="Email id" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="hidden" id="Type" name="Type" value="Agent">
                <button type="submit" name="agent_login" class="login-btn">LOGIN</button>
                <a href="reset_password_agent.php" class="forgot-password">Forgot password?</a>
                <a href="agent_registration.php"><button type="button" class="register-btn">REGISTER</button></a>
            </form>
        </div>
    </div> -->

    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <form action="index.php" method="post">
                <h1> User login</h1>
                <div class="input-box">
                    <input type="text"  name="email" placeholder="Email Id" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password"  placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <input type="hidden" id="Type" name="Type" value="User">
                <div class="remeber-forgot">
                    <!-- <label><input type="checkbox">Remember me</label> -->
                    <a href="reset_password_user.php" class="forgot-password"> Forgot password ?</a>
                </div>
                <button type="submit" class="btn" name="user_login" >Login</button>
                <div class="register-link">
                    <p>Don't have an account ? 
                    <a href="user_registration.php">Signup</a></p>
                </div>
            </form>
        </div>

        <div id="agent-login-box" class="login-box" style="display: none;">
            <form action="index.php" method="post">
                <h1> Agent login</h1>
                <div class="input-box">
                    <input type="text"  name="email" placeholder="Email Id" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password"  placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <input type="hidden" id="Type" name="Type" value="Agent">
                <div class="remeber-forgot">
                    <!-- <label><input type="checkbox">Remember me</label> -->
                    <a href="reset_password_agent.php" class="forgot-password"> Forgot password ?</a>
                </div>
                <button   type="submit" class="btn" name="agent_login" >Login</button>
                <div class="register-link">
                    <p>Don't have an account ? 
                    <a href="agent_registration.php">Signup</a></p>
                </div>
            </form>
        </div>





        

    </div>

<script src="scripts/script.js"></script>
</body>

</html>


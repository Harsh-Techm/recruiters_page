<?php
include "partials/_registration_header.php";
include "database/dbconnect.php";
if (isset($_POST["verify"])) {
    
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password=$_POST["password"];
    
    $sql="SELECT `Phone` from `Users` where `Email`='$email'";
    // echo $sql;
    $result= mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    // var_dump($row);
    if ($result){
        if ($phone == $row['Phone']){
            $query="UPDATE `Users` SET `Password`= '$password' WHERE `Email`='$email'";
            $result= mysqli_query($conn, $query);
            if($result){
                echo"<link rel='stylesheet' href='styles/style.css'>
                    <h1 class='popup1'>Password Updated !</h1>";
            }
            
        }
        else{
            echo"<link rel='stylesheet' href='styles/style.css'>
                    <h1 class='popup1'>Wrong Credential !</h1>";
        }
    


}
    
       
           
    


    
}
?>

<!-- <div class="container">
        
        <div id="user-login-box" class="login-box">
            <div class="login-icon"></div>
            <img src="images\userlogo.png" width="100" height="100">
            <h2>RESET PASSWORD</h2>
            <form method="post">
                
                <input type="text" name="email" placeholder="Email ID:" required>
                <input type="phone" name="phone" placeholder="Phone No.:" required>
                <input type="text" name="password" id="password" minlength="6" maxlength="10" placeholder="Enter New Password">
                <button type="submit" name="verify" class="login-btn">VERIFY</button>
                
               
            </form>
            
        </div>
      
        
</div> -->
<div class="container">
    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <!-- <div class="login-icon"></div> -->
            <!-- <img src="images\userlogo.png" width="100" height="100"> -->
            <h1>Reset Password</h1>
            <form method="post">
                <div class="input-box">
                <input type="text" name="email" placeholder="Email ID:" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                <input type="phone" name="phone" placeholder="Phone No.:" required>
                <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                <input type="text" name="password" id="password" minlength="6" maxlength="10" placeholder="Enter New Password">
                <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" name="verify" class="login-btn btn">VERIFY</button>
                <!-- <a href="#" class="forgot-password">Forgot password?</a>
                <button type="button" class="register-btn">REGISTER</button> -->
               
            </form>
           
        </div>
    </div>
       
</div>



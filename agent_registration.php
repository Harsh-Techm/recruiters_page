<?php
include "partials/_registration_header.php";
if (isset($_POST["agent_register"])) {
    // print_r($_POST);

    $user_name = $_POST["username"];
    // $last_name = $_POST["agent_last_name"];
    $email = $_POST['agent_email'];
    $password = $_POST['agent_password'];
    $confirm_password = $_POST['agent_confirm_password'];
    $mobile = $_POST['agent_mobile_no'];
    // $organization = $_POST['agent_organization'];
    $type = $_POST['Type'];
    if ($password != $confirm_password) {
        echo "Password doesn't matched";
    } else {
        $connection = mysqli_connect('localhost', 'root', '', 'recruitmentpage');

        $query2 = "INSERT INTO `Users` (`UserName`,`Email`,`Password`,`Phone`,`Type`) VALUES ('$user_name','$email','$password','$mobile','$type')";

        $result2 = mysqli_query($connection, $query2);
        if (!$result2) {
            echo"<link rel='stylesheet' href='styles/style.css'>
                   <h1 class='popup1'>Agent already exists !</h1>";
        } else {
            echo"<link rel='stylesheet' href='styles/style.css'>
                <h1 class='popup'>Account created successfully !</h1>";
        }
    }


}
?>


<!-- <div class="container">
    <div id="user-login-box" class="login-box">
       
        <img src="images\agent-logo.png" width="100" height="100">
        <h2>AGENT REGISTRATION</h2>
        <form method="post">
            <input name="username" type="text" placeholder="User Name:" required>
            
            <input name="agent_email" type="email" placeholder="Email Id:" required>
            <input name="agent_mobile_no" type="phone" placeholder="Mobile No.:" required>
           
            <input name="agent_password" type="password" id="ag_password" minlength="6" maxlength="10" placeholder="Password:" required>
            <input name="agent_confirm_password" type="password" id="ag_c_password" minlength="6" maxlength="10" placeholder="Confirm Password:" required>
            <input type="hidden" id="Type" name="Type" value="Agent">
            <p id="error-message" style="color: red;"></p>
            <button type="submit" class="login-btn" name="agent_register">REGISTER NOW</button>
            <button type="reset" class="login-btn">RESET</button>
           
            <script>
            var password = document.getElementById("ag_password");
            var confirmPassword = document.getElementById("ag_c_password");
           
 
            function checkPasswordMatch() {
                console.log(confirmPassword.value);
 
                var errorMessage = document.getElementById("error-message");
 
                if (password.value !== confirmPassword.value) {
                    errorMessage.textContent = "Passwords do not match!";
                    return false; 
                }
 
                errorMessage.textContent = ""; 
                return true; 
            }
 
            confirmPassword.addEventListener('input',checkPasswordMatch);
           
           
        </script>
        </form>

    </div>

</div> -->
<div class="container">
    <div class="wrapper">
        <div id="user-login-box" class="login-box">
            <!-- <div class="login-icon"></div> -->
            <!-- <img src="images\agent-logo.png" width="100" height="100"> -->
            <h1>Agent Registration</h1>
            <form method="post">
                <div class="input-box">
                <input name="username" type="text" placeholder="User Name:" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                <input name="agent_email" type="email" placeholder="Email Id:" required>
                <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                <input name="agent_mobile_no" type="phone" placeholder="Mobile No.:" required>
                <i class='bx bxs-phone'></i>
                </div>
                <div class="input-box">
                <input name="agent_password" type="password" id="ag_password" minlength="6" maxlength="10" placeholder="Password:" required>
                <i class='bx bxs-lock'></i>
                </div>
                <div class="input-box">
                <input name="agent_confirm_password" type="password" id="ag_c_password" minlength="6" maxlength="10" placeholder="Confirm Password:" required>
                <i class='bx bxs-lock'></i>
                </div>
                <input type="hidden" id="Type" name="Type" value="Agent">
                <p id="error-message" style="color: red;"></p>
                <button type="submit" class="login-btn btn" name="agent_register">REGISTER NOW</button>
                <!-- <button type="reset" class="login-btn btn">RESET</button> -->
                <!-- <a href="#" class="forgot-password">Forgot password?</a>
                    <button type="button" class="register-btn">REGISTER</button> -->
                <!-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia, eius nam. Praesentium dolorum quod saepe.</p> -->
                <script>
                var password = document.getElementById("ag_password");
                var confirmPassword = document.getElementById("ag_c_password");
           
   
                function checkPasswordMatch() {
                    console.log(confirmPassword.value);
   
                    var errorMessage = document.getElementById("error-message");
   
                    if (password.value !== confirmPassword.value) {
                        errorMessage.textContent = "Passwords do not match!";
                        return false; // Prevent form submission
                    }
   
                    errorMessage.textContent = ""; // Clear any previous error message
                    return true; // Allow form submission
                }
   
                confirmPassword.addEventListener('input',checkPasswordMatch);
           
           
            </script>
            </form>
 
        </div>
    </div>
</div>


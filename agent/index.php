<?php

if(!isset($_SESSION)){
    // Start Session it is not started yet
    session_start();
}
if(!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin']!=true)
{
    header('location:../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    
    
</head>

<body>
   
    <!-- <div class="navbar">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: red;">HireHub</span></div>
        <div class="nav-links">
            <button id="dashboard-tab" class="tab active">Dashboard</button>
            <a href="project.php"><button class="tab">Project</button></a>
            <a href="search.php"><button  class="tab">Search</button></a>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="agent_logout.php" id="log-out">Log Out</a>
            </div>
        </div>
    </div> -->

    <div class="tab-content active" id="dashboard-content">
    <!-- <h1>Dashboard</h1> -->
        <?php
            include('dashboard.php');            
        ?>
        
    </div>


    <div class="modal" id="user-modal">
        <div class="modal-content">
            <span class="close-btn" onclick="document.getElementById('user-modal').style.display='none'">&times;</span>
            <div class="head">
                <img id="modal-image" height="200px" width="200px" src="" alt="user-image"/>
                <span class="about">
                    <p id="modal-name"></p>
                    <p id="modal-about"></p>
                </span>  
            </div>
            <div class="details">
                <span>
                    <p id="modal-email"></p>
                    <p id="modal-qualification"></p>
                    <p id="modal-skill"></p>
                </span>
                <span id="left">
                    <p id="modal-gender"></p>
                    <p id="modal-age"></p>
                    <p id="modal-location"></p>
                </span>
            </div>
            <a href="#" id="modal-resume" download><button>Download Resume</button>
            </a>
        </div>
    </div>

    
    <script src="script/script.js"></script>
    <script src="script/modal.js"></script>



</body>

</html>
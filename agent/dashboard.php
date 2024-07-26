<?php

if(!isset($_SESSION)){
    // Start Session it is not started yet
    session_start();
}
// session_start();
if (!isset($_SESSION['agentLogin']) || $_SESSION['agentLogin'] != true) {
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
    <link rel="stylesheet" href="styles/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
</head>

<!-- <body>

    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'>SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'>Confirmed data</button>
    </div>

    <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>
        <div class="dashboard-confirm-content"></div>
    </div>

    <div class="modal" id="user-modal">
            <div class="modal-content">
                <span class="close-btn"
                    onclick="document.getElementById('user-modal').style.display='none'">&times;</span>
                <div class="head">
                    <img id="modal-image" height="200px" width="200px" src="" alt="user-image" />
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

    <script src="script/dashboard.js"></script>

</body> -->
<body style="background:url('../images/p (1).jpg') no-repeat; background-size: cover; background-position: center;">
    <div class="navbar">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: skyblue;">HireHub</span></div>
        <div class="nav-links">
            <a href="dashboard.php"><button  style="color: white;"  class="tab active">Dashboard</button></a>
            <a href="project.php"><button style="color: white;" class="tab">Project</button></a>
            <a href="search.php"><button style="color: white;" class="tab">Search</button></a>
        </div>
        <div class="user-menu" onclick="toggleDropdown()">
            <img src="../images/hamburger_icon.png" alt="Icon" class="user-icon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="agent_profile.php" id="edit-profile">Edit Profile</a>
                <a href="#" id="log-out">Log Out</a>
            </div>
        </div>
    </div>
 
    <div class="dashboard-tabs">
        <button name='dataset' value='Softlock Data' class='dashboard-softlock-tab'>SoftLock data</button>
        <button name='dataset' value='Confirmed Data' class='dashboard-confirm-tab'>Confirmed data</button>
    </div>
 
    <div class="dashboard-tab-content">
        <div class="dashboard-softlock-content" id="dashboard-softlock-content"></div>
        <div class="dashboard-confirm-content"></div>
 
 
        <div class="modal" id="user-modal2">
            <div class="modal-content">
                <span class="close-btn2"
                    onclick="document.getElementById('user-modal2').style.display='none'">&times;</span>
                <div class="head">
                    <img id="modal2-image" height="100px" src="" alt="user-image" />
                    <span class="about">
                        <p id="modal2-name"></p>
                        <p id="modal2-about"></p>
                    </span>
                </div>
                <div class="details">
                    <span>
                        <p id="modal2-email"></p>
                        <p id="modal2-qualification"></p>
                        <p id="modal2-skill"></p>
                    </span>
                    <span id="left">
                        <p id="modal2-gender"></p>
                        <p id="modal2-age"></p>
                        <p id="modal2-location"></p>
                    </span>
                </div>
                <a href="#" id="modal2-resume" download><button>Download Resume</button></a>
            </div>
        </div>
 
        <script src="script/dashboard.js"></script>
       
 
    </div>
</body>
</html>
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
 
// $userId = 2;
$userId=$_SESSION['UserId'];
 
//Fetch user details
$sql = "SELECT u.UserName, u.Email, u.Phone, d.FirstName, d.LastName, d.Age, d.Location, d.HighestQualification,d.Experience, d.About, d.Image, d.Resume, d.Gender
FROM users u
JOIN userdetails d ON u.UserId = d.UserId
WHERE u.UserId = $userId";
 
$result = $conn->query($sql);
$userData = $result->fetch_assoc();
 
//Fetch user skills
$sqlSkills = "SELECT s.SkillId, s.SkillName, us.SkillType
FROM userskilldetails us
JOIN skillmaster s ON us.SkillId = s.SkillId
WHERE us.UserId = $userId";
 
$resultSkills = $conn->query($sqlSkills);
$primarySkillId = null;
$secondarySkillIds = [];
 
 
if($resultSkills->num_rows>0){
    while($row= $resultSkills->fetch_assoc()){
        if($row['SkillType'] == 'Primary'){
            $primarySkillId = $row['SkillId'];
        }elseif($row['SkillType'] == 'Secondary'){
            $secondarySkillIds[] = $row['SkillId'];
           
        }
    }
}
 
//Fetch all skills from Skill Master for dropdown options
$sqlAllSkills = "SELECT SkillId, SkillName FROM skillmaster";
$resultAllSkills = $conn->query($sqlAllSkills);
$allSkills=[];
if($resultAllSkills->num_rows>0){
    while($row = $resultAllSkills->fetch_assoc()){
        $allSkills[]=$row;
    }
}
 
//Fetch all locations
$sqlLocations = "SELECT LocationId, LocationName FROM locationmaster";
$resultLocations = $conn->query($sqlLocations);
$locations = [];
if($resultLocations->num_rows>0){
    while($row = $resultLocations->fetch_assoc()){
        $locations[] = $row;
    }
}
$conn->close();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script>
       document.addEventListener("DOMContentLoaded", function(){
        var skillsInput = document.getElementById('secondarySkills');
        var skillsContainer = document.getElementById('selectedSkills');
 
        function addSkillToContainer(skillId, skillName){
            var skillDiv = document.createElement('div');
            skillDiv.className = 'skill-item1';
            skillDiv.dataset.skillId = skillId;
            skillDiv.textContent = skillName;
 
            var removeButton = document.createElement('button');
            removeButton.textContent = 'X';
            removeButton.className = "delbtn";
            removeButton.type = 'button';
            removeButton.onclick = function(){
                removeSkill(skillId, skillDiv);
            };
            skillDiv.appendChild(removeButton);
            skillsContainer.appendChild(skillDiv);
        }
 
        function addSkill(){
            var select = document.getElementById('secondarySkillSelect');
            var selectedSkillId = select.value;
            var selectedSkillName = select.options[select.selectedIndex].text;
 
            if(selectedSkillId){
                addSkillToContainer(selectedSkillId, selectedSkillName);
                updateSkillsInput();
            }
        }
 
        function removeSkill(skillId, skillDiv){
            var skillIds = skillsInput.value.split(',');
            var index = skillIds.indexOf(skillId);
            if(index !== -1){
                skillIds.splice(index, 1);
                skillsInput.value = skillIds.join(',');
                skillsContainer.removeChild(skillDiv);
            }
        }
        function updateSkillsInput(){
            var skillIds = Array.from(skillsContainer.children).map(function(skillDiv){
                return skillDiv.dataset.skillId;
            });
            skillsInput.value = skillIds.join(',');
        }
 
        document.getElementById('addSkillButton').addEventListener('click', addSkill);
 
        <?php
        foreach($secondarySkillIds as $skillId){
            $skillName = "";
            foreach ($allSkills as $skill){
                if($skill['SkillId'] == $skillId){
                    $skillName = $skill['SkillName'];
                    break;
                }
            }
            echo "addSkillToContainer('$skillId', '$skillName');";
        }
        ?>
       });
    </script>
    <style>
         .skill-item1{
            margin-right: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            display: inline-block;
         }
         .delbtn{
            border: none;
            border-radius: 50%;
            font-size: 8px;
            margin: 5px;
            margin-right: -3px;
            padding: 5px;
            color: black;
            background-color: lightgrey;
         }
         #addSkillButton{
            padding: 5px;
            margin: 5px;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            color: #fff;
            background: linear-gradient(135deg, #fda1a1 0%, #ff0000 100%);
         }
         #addSkillButton:hover{
            background:linear-gradient(135deg, #ff0000 0%,#fda1a1  100%);
          box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            transform: translateY(-5px);
            cursor: pointer;
}
    </style>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <h2 class="text-center mb-4">Edit Profile</h2>
                    <!-- <button class="btn btn-primary edit-button" onclick="enableEditing()">Edit Profile</button> -->
                    <form id="profile-form" action="update_profile.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="firstName" value="<?php echo $userData['FirstName']; ?>"  required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="lastName" value="<?php echo $userData['LastName']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $userData['Age']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select name="location" id="location" class="form-select">
                                <?php foreach($locations as $location) { ?>
                                    <option value="<?php echo $location['LocationId']; ?>" <?php if($location['LocationId'] == $userData['Location']) echo 'selected';?>>
                                        <?php echo $location['LocationName']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <select name="experience" id="experience" class="form-control" required>
                                <?php for ($i = 1; $i <= 30; $i++): ?>
                                    <option value="<?php echo $i . ' year' . ($i > 1 ? 's' : ''); ?>" <?php if ($userData['Experience'] == $i) echo 'selected'; ?>>
                                        <?php echo $i . ' year' . ($i > 1 ? 's' : ''); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Highest Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="highestQualification" value="<?php echo $userData['HighestQualification']; ?>"  required>
                        </div>
                        <div class="form-group">
                            <label for="primarySkill" class="form-label">Primary Skill</label>
                            <select name="primarySkill" id="primarySkill"  class="form-control >
                               <option value="">Select Primary Skill</option>
                               <?php foreach ($allSkills as $skill) { ?>
                                    <option value="<?php echo $skill['SkillId']; ?>" <?php if ($skill['SkillId']== $primarySkillId) echo 'selected'; ?>>
                                        <?php echo $skill['SkillName']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="secondarySkills" class="form-label">Secondary Skills</label>
                            <input type="hidden" id="secondarySkills" name="secondarySkills" value="<?php echo implode(", ", $secondarySkillIds); ?>">
                            <div id="selectedSkills"></div>
                                <select  id="secondarySkillSelect">
                                    <?php foreach ($allSkills as $skill){ ?>
                                        <option value="<?php echo $skill['SkillId']; ?>"><?php echo $skill['SkillName']; ?></option>
                                        <?php } ?>
                                </select>
                                 
                            <button type="button" id="addSkillButton" onclick="addSkill()">Add Skill</button>
                        </div>
                       
 
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea class="form-control" id="about" name="about" required><?php echo $userData['About']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <input type="file" class="form-control" id="resume" name="resume">
                        </div>
                        <!-- <div class="form-group">
                            <label for="organization">Organization</label>
                            <input type="text" class="form-control" id="organization" name="organization" value="<?php echo htmlspecialchars($organization); ?>" required>
                        </div> -->
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $userData['Phone']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="">Select your gender</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                                <!-- <option value="other">Other</option> -->
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($gender); ?>" required>
                        </div> -->
                        <button type="submit" class="btn btn-success btn-block" style="background-color:maroon;" id="btn-save">Save Changes</button>
                    </form>
                </div>
            </div>    
        </div>
 
    </div>
   
    </body>
</html>
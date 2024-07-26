<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$dbName = "RecruitmentPage";
$dbCreationSQL = "CREATE DATABASE if NOT EXISTS $dbName";

if ($conn->query($dbCreationSQL) === FALSE) {
  echo "Error creating database: " . $conn->error;
}

//                        users table
$usertablecreation = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`users` ( `UserId` INT(50) NOT NULL AUTO_INCREMENT , `UserName` VARCHAR(50) NOT NULL , `Password` VARCHAR(25) NOT NULL , `Type` VARCHAR(25) NOT NULL , `Email` VARCHAR(50) NOT NULL UNIQUE , `Phone` VARCHAR(15) NOT NULL , PRIMARY KEY (`UserId`)) ENGINE = InnoDB";

if ($conn->query($usertablecreation) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       userDetails table
$userdetails = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`userdetails` ( 
`SlNo` INT(50) NOT NULL AUTO_INCREMENT, `UserId` INT(50) NOT NULL , 
`FirstName` VARCHAR(50) NOT NULL , 
`LastName` VARCHAR(50) NOT NULL , `Age` INT(2) NOT NULL , `Location` INT(10) NOT NULL , `Email` VARCHAR(25) NOT NULL , `HighestQualification` VARCHAR(25) NOT NULL , `Experience` VARCHAR(25) NOT NULL , `About` VARCHAR(300) NOT NULL , 
`Image` LONGBLOB NOT NULL , 
`Resume` LONGBLOB NOT NULL , 
`Gender` VARCHAR(1) NOT NULL,
PRIMARY KEY (`SlNo`),FOREIGN KEY (`Email`) REFERENCES `users`(`Email`),FOREIGN KEY (`UserId`) REFERENCES `users`(`UserId`),FOREIGN KEY (`Location`) REFERENCES `locationmaster`(`LocationId`)) ENGINE = InnoDB";

if ($conn->query($userdetails) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       SkillMaster table
$skillmaster = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`skillmaster` ( `SkillId` INT(20) NOT NULL AUTO_INCREMENT , `SkillName` VARCHAR(50) NOT NULL , PRIMARY KEY (`SkillId`)) ENGINE = InnoDB
";

if ($conn->query($skillmaster) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       LocationMaster table
$locationmaster = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`locationmaster` ( `LocationId` INT(20) NOT NULL AUTO_INCREMENT , `LocationName` VARCHAR(20) NOT NULL , PRIMARY KEY (`LocationId`)) ENGINE = InnoDB";

if ($conn->query($locationmaster) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       CustomerMaster table
$customermaster = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`customermaster` ( `CustomerId` INT(20) NOT NULL AUTO_INCREMENT , `CustomerName` VARCHAR(25) NOT NULL , `CustomerLocation` INT(25) NOT NULL , PRIMARY KEY (`CustomerId`) , FOREIGN KEY (`CustomerLocation`) REFERENCES `locationmaster`(`LocationId`)) ENGINE = InnoDB;
";

if ($conn->query($customermaster) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       project table
$project = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`project` ( `ProjectId` INT(20) NOT NULL AUTO_INCREMENT , `CustomerId` INT(20) NOT NULL , `StartDate` DATE NOT NULL , `EndDate` DATE NOT NULL , `Location` INT(20) NOT NULL , `ProjectName` VARCHAR(50) NOT NULL , PRIMARY KEY (`ProjectId`) ,FOREIGN KEY (`CustomerId`) REFERENCES `customermaster`(`CustomerId`) , FOREIGN KEY (`Location`) REFERENCES `locationmaster`(`LocationId`)) ENGINE = InnoDB
";
if ($conn->query($project) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       UserProjectDetails table
$userprojectdetail = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`userprojectdetails` ( `SlNo` INT(20) NOT NULL AUTO_INCREMENT , `Status` VARCHAR(25) NOT NULL , `UserId` INT(25) NOT NULL , `AgentId` INT(25) NOT NULL , `ProjectId` INT(25) NOT NULL , PRIMARY KEY (`SlNo`),FOREIGN KEY (`UserId`) REFERENCES `users`(`UserId`),FOREIGN KEY (`AgentId`) REFERENCES `users`(`UserId`),FOREIGN KEY (`ProjectId`) REFERENCES `Project`(`ProjectId`)) ENGINE = InnoDB;
";
if ($conn->query($userprojectdetail) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

//                       UserSkillDetails table
$userskilldetails = "CREATE TABLE if NOT EXISTS `recruitmentpage`.`userskilldetails` ( `SlNo` INT(25) NOT NULL AUTO_INCREMENT , `UserId` INT(25) NOT NULL , `SkillId` INT(25) NOT NULL , `SkillType` VARCHAR(25) NOT NULL , PRIMARY KEY (`SlNo`), FOREIGN KEY (`UserId`) REFERENCES `users`(`UserId`), FOREIGN KEY (`SkillId`) REFERENCES `skillmaster`(`SkillId`)) ENGINE = InnoDB;";

if ($conn->query($userskilldetails) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

// Insert Dummy Data
$sql="INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'New York');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'London');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Amsterdam');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Paris');
      INSERT INTO `locationmaster` (`LocationId`, `LocationName`) VALUES (NULL, 'Madrid');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'PHP');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'Java');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'Python');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'JavaScript');
      INSERT INTO `skillmaster` (`SkillId`, `SkillName`) VALUES (NULL, 'NodeJs');
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'John Doe',1);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Michael Paul',2);
      INSERT INTO `customermaster` (`CustomerId`, `CustomerName`,`CustomerLocation`) VALUES (NULL, 'Jonathan Jobs',3);
      ";
// if ($conn->query($sql) === FALSE) {
//   echo "Error creating table: " . $conn->error;
// }
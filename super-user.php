<?php
include("database/dbconnect.php");

$sql="SELECT * FROM `users`;";
$result = mysqli_query($conn, $sql);


if (isset($_POST["id"]))
{

    $delete=$_POST['Delete'];
    if($delete=='Delete_user')
    {
        $Email=$_POST['id'];
        echo $Email;
        $sql="DELETE FROM `user_credentials` where `user_credentials`.Email = '$Email'";
        $sql2="DELETE FROM `user_data` where `user_data`.Email='$Email'";
        $stmt=mysqli_query($conn, $sql);
        $res=mysqli_query($conn,$sql2);
        if($stmt)
        {
            echo "Record Deleted successfully";
        }
        else{
            echo "Error deleting record".$conn->error;
        } 
    }
    else{
        $Email=$_POST['id'];
        echo $Email;
        $sql="DELETE FROM `agent_credentials` where `agent_credentials`.Email='$Email'";
        $sql2="UPDATE `user_data` SET `user_data`.confirm='0',`user_data`.softlock='0',`user_data`.agent='' where `user_data`.agent='$Email'";
        $res=mysqli_query($conn,$sql2);
        $stmt=mysqli_query($conn, $sql);
        if($stmt)
        {
            echo "Record Deleted successfully";
        }
        else{
            echo "Error deleting record".$conn->error;
        } 
    } 

}
$conn->close();





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Portal</title>
    <link rel="stylesheet" href="agent/styles/index.css">
    
</head>
<body>
    <div class="navbar">
        <div class="logo"><span style="color: white;">Tech</span> <br><span style="color: red;">HireHub</span></div>
        <div class="nav-links">        
            <form method="post" action='super-user.php'>
                <button type="submit" name="usubmit" value='user_submit' id="dashboard-tab" class="tab" style="color: white;">User</button>
                <button type="submit" name="usubmit" value='agent_submit' id="search-tab" class="tab" style="color: white;">Agent</button>
            </form>
        </div>   
    </div>

    <!-- <div class="tab-content" id="confirmed"> -->
            <?php
                if (isset($_POST["usubmit"]))
                {
                    $dataset=$_POST['usubmit'];
                    if ($dataset=='user_submit')
                    {
                        echo '<img src="image\computer-1331579_640.webp" width="100" height="100" style="margin-left:650px;">';
                        if($result-> num_rows>0)
                        {
                            echo "<h1 style='margin-left:150px;'>User Data:</h1>";
                            echo"<table border='1' style='margin-left:150px;height:150px;width:1000px;'>";
                            echo "<tr>
                                <th> UserId </th>
                                <th>Name</th> 
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>  
                            </tr>";
                            while($row=$result->fetch_assoc())
                            {
                                echo "<tr>
                                    <td>" . $row['UserId'] ."</td>
                                    <td>" . $row['UserName'] ."</td>
                                    <td>" . $row['Email'] ."</td>
                                    <td>" . $row['Type'] ."</td>  
                                    <td> 
                                        <form method='post' action='super_user_page.php'>
                                            <input type='hidden' id='id' name='id' value=".$row['Email'].">".
                                            "<input type='submit' value='Delete_user' name='Delete' style='height:40px;width:100px;'>
                                        </form>
                                    </td>
                                    </tr>";
                            }
                            echo"</table>";      
                        }
                        else{
                            echo "<tr><td colspan='4'>No User Records Founds</td></tr>";
                        }
                    }
                    else
                    {
                        echo '<img src="/3_recruiters_portal/image/agent logo.png" width="100" height="100" style="margin-left:650px;">';
                        
                        if($result-> num_rows>0)
                        {
                            echo "<h1 style='margin-left:150px;'>Agent Data:</h1>";
                            echo"<table border='1' style='margin-left:150px;height:150px;width:1000px;'>";
                            echo"<tr><th> Agent_id </th><th> First name</th> <th> Last name</th> <th>Email</th></tr>";
                            while($row=$result->fetch_assoc())
                            {
                                echo"<tr><td>" . $row['Agent_id'] ."</td><td>" . $row['First name'] ."</td> <td>" . $row['Last name'] . "</td> <td>" . $row['Email'] . "</td> <td> <form method='post' action='super_user_page.php'><input type='hidden' name='id' value=".$row['Email'].">"."<input type='submit' value='Delete_agent' name='Delete' style='height:40px;width:100px;'></form></td></tr>";
                            }
                            echo"</table>"; 
                        }
                        else
                        {
                            echo "<tr><td colspan='4'>No Agent Records Founds</td></tr>";
                        }
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
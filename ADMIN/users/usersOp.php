<?php
include "../../Database/db.php";

$id = 0;
$gender = "";
$lastName = "";
$firstName = "";
$email = "";
$phoneNumber = "";
$username = "";
$password = "";
$project ="";
$region = "";
$province = "";
$birthday = "";
$edit_state = false;

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));

    if(empty($textbox)){
        return false;
    }
    else{
        return $textbox;
    }
}

if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    updateData();
}

if(isset($_POST['delete'])){
    deleteData();
}

function createData(){
    $id = textboxValue("id");
    $gender = textboxValue("gender");
    $lastName = textboxValue("lastName");
    $firstName = textboxValue("firstName");
    $email = textboxValue("email");
    $phoneNumber = textboxValue("phoneNumber");
    $username = textboxValue("username");
    $password = textboxValue("password");
    $project =textboxValue("project");
    $region = textboxValue("region");
    $province = textboxValue("province");
    $birthday = textboxValue("birthday");


    $image = $_FILES['picture']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 
    
    if($gender && $lastName && $firstName && $email && $phoneNumber && $username && $password && $project && $region && $birthday && $image && $province){
        //checks if entered category room exist in database
        $sql = "SELECT
                    *
                FROM
                    users
                WHERE
                email = '$email' OR username = '$username'
                ";
        $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

        $created_at = date("Y-m-d");

        

        if(mysqli_num_rows($result) == 0){
            
            $sql = "INSERT INTO users (id, username, password, created_at, lastName, firstName, birthday, email, gender, project, region, province, phoneNumber, picture) 
            VALUES(null,'$username','$password','$created_at','$lastName','$firstName','$birthday','$email','$gender','$project','$region', '$province', '$phoneNumber','$imgContent')";    

            if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                
                ?> 
                <script> 
                    alert("User has been added succesfully!")
                </script>              
                <?php
                header("Refresh:0; url=users.php");
        
            }

        }  
          
        else{
            $error = "User Already Exists!";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:0; url=users.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=users.php");
    }

}

function updateData(){
    $id = textboxValue("id");
    $gender = textboxValue("gender");
    $lastName = textboxValue("lastName");
    $firstName = textboxValue("firstName");
    $email = textboxValue("email");
    $phoneNumber = textboxValue("phoneNumber");
    $username = textboxValue("username");
    $password = textboxValue("password");
    $project =textboxValue("project");
    $region = textboxValue("region");
    $province = textboxValue("province");
    $birthday = textboxValue("birthday");
    
    $image = $_FILES['picture']['tmp_name']; 
      
    if($gender && $lastName && $firstName && $email && $phoneNumber && $username && $password && $project && $region && $birthday && $province){
        
        $sql = "UPDATE users 
                SET `username`='$username',`password`='$password',`lastName`='$lastName',`firstName`='$firstName',
                    `birthday`= '$birthday',`email`= '$email',`gender`= '$gender',`project`='$project',`region`= '$region',`phoneNumber`='$phoneNumber', `province`='$province'
                WHERE id= '$id'";
                

        $sql2 = "SELECT *  
                FROM users 
                WHERE username = '$username' AND email = '$email' AND project = '$project' AND region = '$region' AND  gender = '$gender' AND province = '$province'";

        $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']));
            

            

                if(!($image)){ //if no image is uploaded proceed
                    if(mysqli_num_rows($result2) == 0){ //checks if any there are any conflicting data
                        $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                        if($result){ //checks if the query was run succesfully
                            ?>
                            <script> 
                                alert("User has been updated succesfully!")
                            </script>              
                            <?php
                            header("Refresh:0; url=users.php");
                        }    
                    }
                    else{
                        $error = "User Conflict with existing User! Check username or email.";
                        echo '<script type="text/javascript">alert("'.$error.'");</script>';
                        header("Refresh:0; url=users.php");
                    }
                }
                else{ //else there is an image uploaded 
                    $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                    $imgContent = addslashes(file_get_contents($image)); 
                    $sql =
                            "UPDATE users 
                            SET `picture`='$imgContent'
                            WHERE id= '$id'";

                    
                    mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn'])); //query to update image in databsae
                    header("Refresh:0; url=users.php");
                }      

    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=users.php");
    }        
}


function deleteData(){
    $id = textboxValue("id");
    
    
    $sql = "DELETE FROM users WHERE id = '$id'";
    
    if($id){
        
            if(mysqli_query($GLOBALS['conn'], $sql)){
                
                    ?> 
                    <script> 
                        alert("User Deleted!")
                    </script>              
                    <?php
                    header("Refresh:0; url=users.php");
        
            }
            else{
                ?> 
                <script> 
                    alert("Can't Delete User!")
                </script>              
                <?php
                header("Refresh:0; url=users.php");
            }
       
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=users.php");
    }    
}

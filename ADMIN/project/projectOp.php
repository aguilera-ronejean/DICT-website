<?php
include "../../Database/db.php";

$id = 0;
$project = "";

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
    $project = textboxValue("project");
    
    if($project){
        //checks if entered category room exist in database
        $sql = "SELECT
                    *
                FROM
                    project
                WHERE
                    project = '$project'
                ";
        

        $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));
        
  
        if(mysqli_num_rows($result) == 0){
            
            $sql = "insert into project(id, project) 
            values('','$project')";    

            if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                
                ?> 
                <script> 
                    alert("Project has been added succesfully!")
                </script>              
                <?php
                header("Refresh:0; url=project.php");
        
            }

        }  
          
        else{
            $error = "Project Already Exists!";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:0; url=project.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=project.php");
    }

}

function updateData(){
    $id = textboxValue("id");
    $project = textboxValue("project"); 
      
    if($project){
        
        $sql = "UPDATE project 
                SET project = '$project' 
                WHERE id= '$id'";

        $sql2 = "SELECT project 
                FROM project 
                WHERE project = '$project'";

        $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']));
            

            if(mysqli_num_rows($result2) == 0){
                $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                if($result){
                    ?>
                    <script> 
                        alert("Project has been updated succesfully!")
                    </script>              
                    <?php
                    header("Refresh:0; url=project.php");
                }    
                
            }   
        
            else{
                $error = "Project Already Exists!";
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
                header("Refresh:0; url=project.php");
            }
            

    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=project.php");
    }        
}

function deleteData(){
    $id = textboxValue("id");
    $project = textboxValue("project");

    $sql = "DELETE FROM project WHERE id = '$id'";
    
    if($id && $project){

    
        if(mysqli_query($GLOBALS['conn'], $sql)){
            
                ?> 
                <script> 
                    alert("Project Deleted!")
                </script>              
                <?php
                header("Refresh:0; url=project.php");
    
        }
        else{
            ?> 
            <script> 
                alert("Can't Delete Project!")
            </script>              
            <?php
            header("Refresh:0; url=project.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=project.php");
    }    
}

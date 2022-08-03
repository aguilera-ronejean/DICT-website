<?php
include "../../Database/db.php";
session_start();

$id = "";
$project = "";
$activity = "";
$activity_type = "";
$performance_indicator = "";
$target_first_sem = "";
$target_second_sem = "";
$target_month = "";
$variance = "";
$issues = "";
$remarks = "";
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
    $activity = textboxValue("activity");
    $activity_type = textboxValue("activity_type");
    $performance_indicator = textboxValue("performance_indicator");
    $target_first_sem = textboxValue("target_first_sem");
    $target_second_sem = textboxValue("target_second_sem");
    $target_month = textboxValue("target_month");
    $variance = textboxValue("variance");
    $issues = textboxValue("issues");
    $remarks = textboxValue("remarks");
    $year = $_SESSION['year_reporttemplate'];
    
    if($project && $activity && $activity_type){
        //checks if entered category room exist in database
        $sql = "SELECT *
                FROM report
                WHERE project = '$project' AND activity = '$activity' AND activity_type = '$activity_type' AND performance_indicator = '$performance_indicator'";
        $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));
        

        if(mysqli_num_rows($result) == 0){
            
            $sql = "INSERT INTO report(`id`, `project`, `activity`, `activity_type`, `performance_indicator`, `variance`, `issues`, `remarks`) 
                    VALUES(null, '$project', '$activity', '$activity_type', '$performance_indicator', '$variance', '$issues', '$remarks')"; 
            $sql1 = "SELECT id AS report_id FROM report WHERE `project`='$project' AND `activity`='$activity' AND `activity_type`='$activity_type'";
            if(mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']))){
                $result = mysqli_query($GLOBALS['conn'], $sql1);
                $row = mysqli_fetch_array($result);
                $report_id = $row['report_id'];
                $sql2 = "INSERT INTO target(`report_id`, `year`, `target_first_sem`, `target_second_sem`, `target_month`)
                VALUES('$report_id', '$year', '$target_first_sem', '$target_second_sem', '$target_month')";
                mysqli_query($GLOBALS['conn'], $sql2);
                
                ?> 
                <script> 
                    alert("Report has been added succesfully!")
                </script>              
                <?php
                header("Refresh:0; url=reporttemplate.php");
                
            }

        }  
          
        else{
            $error = "Report Already Exists!";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:5; url=reporttemplate.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=reporttemplate.php");
    }

}


function updateData(){
    $id = textboxValue("id");
    $project = textboxValue("project");
    $activity = textboxValue("activity");
    $activity_type = textboxValue("activity_type");
    $performance_indicator = textboxValue("performance_indicator");
    $target_first_sem = textboxValue("target_first_sem");
    $target_second_sem = textboxValue("target_second_sem");
    $target_month = textboxValue("target_month");
    $variance = textboxValue("variance");
    $issues = textboxValue("issues");
    $remarks = textboxValue("remarks");
    $year = $_SESSION['year_reporttemplate'];
      
    if($id && $project && $activity && $activity_type){
        
        $sql = "UPDATE report
                SET `project`='$project', `activity`='$activity', `activity_type`='$activity_type', `performance_indicator`='$performance_indicator', `variance`= '$variance', `issues`= '$issues', `remarks`= '$remarks'
                WHERE id= '$id'";
        $sql1 = "SELECT report_id FROM target
                WHERE report_id='$id' AND `year`='$year'";
        $sql2 = "INSERT INTO target(`report_id`, `year`, `target_first_sem`, `target_second_sem`, `target_month`)
                VALUES('$id', '$year', '$target_first_sem', '$target_second_sem', '$target_month')";
        $sql3 = "UPDATE target
                SET target_first_sem='$target_first_sem', target_second_sem='$target_second_sem', target_month='$target_month'
                WHERE report_id='$id' AND `year`='$year'";
        
        mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));
        $result1 = mysqli_query($GLOBALS['conn'], $sql1);    
       
            if(mysqli_num_rows($result1) == 0){ //checks if any there are any conflicting data
                if(mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']))){ //checks if the query was run succesfully
                        ?>
                        <script> 
                            alert("Report has been updated succesfully!")
                        </script>              
                        <?php
                        header("Refresh:0; url=reporttemplate.php"); 
                }
            
            } else{
                if(mysqli_query($GLOBALS['conn'], $sql3) or die( mysqli_error($GLOBALS['conn']))){ //checks if the query was run succesfully
                    ?>
                    <script> 
                        alert("Report has been updated succesfully!")
                    </script>              
                    <?php
                    header("Refresh:0; url=reporttemplate.php"); 
            }
            }
            /*
            else{
                $error = "User Conflict with existing User! Check username or email.";
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
                header("Refresh:0; url=reporttemplate.php");
            }
            */
        //}
        /*
        else{ //else there is an image uploaded 
            $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

            $imgContent = addslashes(file_get_contents($image)); 
            $sql =
                    "UPDATE users 
                    SET `picture`='$imgContent'
                    WHERE id= '$id'";

            
            mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn'])); //query to update image in databsae
            header("Refresh:0; url=reporttemplate.php");
        }
        */   

    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=reporttemplate.php");
    }      
}


function deleteData(){
    $id = textboxValue("id");
    $year = $_SESSION['year_reporttemplate'];
    
    $sql = "DELETE FROM report WHERE id = '$id'";
    $sql1 = "DELETE FROM target WHERE report_id = $id AND year='$year'";
    
    if($id){
        
            if(mysqli_query($GLOBALS['conn'], $sql) && mysqli_query($GLOBALS['conn'], $sql1)){
                ?> 
                <script> 
                    alert("Report Deleted!")
                </script>              
                <?php
                header("Refresh:0; url=reporttemplate.php");           
            }
            else{
                ?> 
                <script> 
                    alert("Can't Delete Report!")
                </script>              
                <?php
                header("Refresh:0; url=reporttemplate.php");
            }
       
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=reporttemplate.php");
    }    
}

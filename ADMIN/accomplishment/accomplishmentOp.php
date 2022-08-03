<?php
include "../../Database/db.php";

$idAC = "";   $quarter = "";  $project = "";  $activity=""; $region = ""; $region1 = "";   $province = ""; $province1 = ""; $track = "";    $title = "";    $start_Date = "";
$end_Date = ""; $start_Time ="";    $end_Time = ""; $mode = ""; $type = ""; $conducted_By = ""; $resourse_Person = "";  $remarks = "";

$male = "0";    $female = "0";  $senior_Male = "0"; $senior_Female = "0";   $pwd_Male = "0";    $pwd_Female = "0";  $male_R4B_ORM = "0";
$female_R4B_ORM = "0";  $male_R4B_OCM = "0";    $female_R4B_OCM = "0";  $male_R4B_MAR = "0";    $female_R4B_MAR = "0";
$male_R4B_ROM = "0";    $female_R4B_ROM = "0";  $male_R4B_PAL = "0";    $female_R4B_PAL = "0";  $male_R5_ALB = "0";
$female_R5_ALB = "0";   $male_R5_CAM_NOR = "0"; $female_R5_CAM_NOR = "0";   $male_R5_CAM_SUR = "0"; $female_R5_CAM_SUR = "0";
$male_R5_CAT = "0";     $female_R5_CAT = "0";   $male_R5_MAS = "0";     $female_R5_MAS = "0";   $male_R5_SOR = "0"; $female_R5_SOR = "0";
$female_R5_OP = "0";    $male_R5_OP = "0";      $female_R5_OP = "0";

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
    $quarter = textboxValue("quarter");
    $project = textboxValue("project");
    $activity = textboxValue("activity");
    $region = textboxValue("region");
    $province = textboxValue("province");
    $track = textboxValue("track");
    $title = textboxValue("title");
    $start_Date = textboxValue("start_Date");
    $end_Date =textboxValue("end_Date");
    $start_Time = textboxValue("start_Time");
    $end_Time = textboxValue("end_Time");
    $mode = textboxValue("mode");
    $type = textboxValue("type");
    $conducted_By = textboxValue("conducted_By");
    $resourse_Person = textboxValue("resourse_Person");
    
    $remarks = textboxValue("remarks");

    $male = textboxValue("male");
    $female = textboxValue("female"); 
    $senior_Male = textboxValue("senior_Male");
    $senior_Female = textboxValue("senior_Female");
    $pwd_Male = textboxValue("pwd_Male");
    $pwd_Female = textboxValue("pwd_Female");

    $region_R4B = textboxValue("region_R4B");
    $region_ORM = textboxValue("region_ORM");
    $male_R4B_ORM = textboxValue("male_R4B_ORM");
    $female_R4B_ORM = textboxValue("female_R4B_ORM");

    $region_OCM = textboxValue("region_OCM");
    $male_R4B_OCM = textboxValue("male_R4B_OCM");
    $female_R4B_OCM = textboxValue("female_R4B_OCM");

    $region_MAR = textboxValue("region_MAR");
    $male_R4B_MAR = textboxValue("male_R4B_MAR");
    $female_R4B_MAR = textboxValue("female_R4B_MAR");

    $region_ROM = textboxValue("region_ROM");
    $male_R4B_ROM = textboxValue("male_R4B_ROM");
    $female_R4B_ROM = textboxValue("female_R4B_ROM");

    $region_PAL = textboxValue("region_PAL");
    $male_R4B_PAL = textboxValue("male_R4B_PAL");
    $female_R4B_PAL = textboxValue("female_R4B_PAL");

    $region_R5 = textboxValue("region_R5");
    $region_ALB = textboxValue("region_ALB");
    $male_R5_ALB = textboxValue("male_R5_ALB");
    $female_R5_ALB = textboxValue("female_R5_ALB");

    $region_CAM_NOR = textboxValue("region_CAM_NOR");
    $male_R5_CAM_NOR = textboxValue("male_R5_CAM_NOR");
    $female_R5_CAM_NOR = textboxValue("female_R5_CAM_NOR");

    $region_CAM_SUR = textboxValue("region_CAM_SUR");
    $male_R5_CAM_SUR = textboxValue("male_R5_CAM_SUR");
    $female_R5_CAM_SUR = textboxValue("female_R5_CAM_SUR");

    $region_CAT = textboxValue("region_CAT");
    $male_R5_CAT = textboxValue("male_R5_CAT");
    $female_R5_CAT = textboxValue("female_R5_CAT");

    $region_MAS = textboxValue("region_MAS");
    $male_R5_MAS = textboxValue("male_R5_MAS");
    $female_R5_MAS = textboxValue("female_R5_MAS");
    
    $region_SOR = textboxValue("region_SOR");
    $male_R5_SOR = textboxValue("male_R5_SOR");
    $female_R5_SOR = textboxValue("female_R5_SOR");

    $region_R5_OP = textboxValue("region_R5_OP");
    $male_R5_OP = textboxValue("male_R5_OP");
    $female_R5_OP = textboxValue("female_R5_OP");
    
    $total = $male + $female + $senior_Male + $senior_Female;
    $days = ((strtotime($end_Date) - strtotime($start_Date))/(60*60*24));
    $duration = ((strtotime($end_Time) - strtotime($start_Time))/(60*60))*$days;
    
    if($quarter && $project && $region && $province && $track && $title && $end_Date && $start_Date && $start_Time && $end_Time && $mode && $type && $conducted_By && $resourse_Person){
        
            $sql = "INSERT INTO `accomplishment`(`id`, `quarter`, `project`, `activity`, `region`, `province`, `track`, 
                                `title`, `start_Date`, `end_Date`, `duration`, `start_Time`, `end_Time`, `mode`, 
                                `type`, `conducted_By`, `resourse_Person`, `male`, `female`, `senior_Male`, 
                                `senior_Female`, `pwd_Male`, `pwd_Female`, `total`, `acc_att_ID`,`remarks`)
                                
                    VALUES ('','$quarter','$project','$activity','$region','$province','$track','$title','$start_Date','$end_Date',
                            '$duration','$start_Time','$end_Time','$mode','$type','$conducted_By','$resourse_Person',
                            '$male','$female','$senior_Male','$senior_Female','$pwd_Male','$pwd_Female','$total','','$remarks')";    

            if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){

                $sql_getID = "SELECT id FROM accomplishment WHERE quarter = '$quarter' AND track = '$track' AND project = '$project' AND title = '$title' AND region = '$region'";
                $result_getID = mysqli_query($GLOBALS['conn'], $sql_getID) or die( mysqli_error($GLOBALS['conn']));
                $row_getID = mysqli_fetch_array($result_getID);
                $acc_att_ID = $row_getID['id'];

                $sql_update_acc_att_ID = "UPDATE accomplishment 
                                        SET `acc_att_ID`='$acc_att_ID'
                                        WHERE id= '$acc_att_ID'";
                mysqli_query($GLOBALS['conn'], $sql_update_acc_att_ID) or die( mysqli_error($GLOBALS['conn']));
                
                $sql_ORM = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                            VALUES ('$acc_att_ID','$region_R4B','$region_ORM','$male_R4B_ORM','$female_R4B_ORM')";
                
                if(mysqli_query($GLOBALS['conn'], $sql_ORM)or die( mysqli_error($GLOBALS['conn']))){
                    $sql_OCM = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                VALUES ('$acc_att_ID','$region_R4B','$region_OCM','$male_R4B_OCM','$female_R4B_OCM')";

                    if(mysqli_query($GLOBALS['conn'], $sql_OCM)or die( mysqli_error($GLOBALS['conn']))){
                        $sql_MAR = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                    VALUES ('$acc_att_ID','$region_R4B','$region_MAR','$male_R4B_MAR','$female_R4B_MAR')";

                        if(mysqli_query($GLOBALS['conn'], $sql_MAR)or die( mysqli_error($GLOBALS['conn']))){
                            $sql_ROM = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                        VALUES ('$acc_att_ID','$region_R4B','$region_ROM','$male_R4B_ROM','$female_R4B_ROM')";

                            if(mysqli_query($GLOBALS['conn'], $sql_ROM)or die( mysqli_error($GLOBALS['conn']))){
                                $sql_PAL = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                            VALUES ('$acc_att_ID','$region_R4B','$region_PAL','$male_R4B_PAL','$female_R4B_PAL')";

                                if(mysqli_query($GLOBALS['conn'], $sql_PAL)or die( mysqli_error($GLOBALS['conn']))){
                                    $sql_ALB = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                VALUES ('$acc_att_ID','$region_R5','$region_ALB','$male_R5_ALB','$female_R5_ALB')";

                                    if(mysqli_query($GLOBALS['conn'], $sql_ALB)or die( mysqli_error($GLOBALS['conn']))){
                                        $sql_CAM_NOR = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                    VALUES ('$acc_att_ID','$region_R5','$region_CAM_NOR','$male_R5_CAM_NOR','$female_R5_CAM_NOR')";

                                        if(mysqli_query($GLOBALS['conn'], $sql_CAM_NOR)or die( mysqli_error($GLOBALS['conn']))){
                                            $sql_CAM_SUR = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                        VALUES ('$acc_att_ID','$region_R5','$region_CAM_SUR','$male_R5_CAM_SUR','$female_R5_CAM_SUR')";

                                            if(mysqli_query($GLOBALS['conn'], $sql_CAM_SUR)or die( mysqli_error($GLOBALS['conn']))){
                                                $sql_CAT = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                            VALUES ('$acc_att_ID','$region_R5','$region_CAT','$male_R5_CAT','$female_R5_CAT')";

                                                if(mysqli_query($GLOBALS['conn'], $sql_CAT)or die( mysqli_error($GLOBALS['conn']))){
                                                    $sql_MAS = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                                VALUES ('$acc_att_ID','$region_R5','$region_MAS','$male_R5_MAS','$female_R5_MAS')";
                                                                
                                                    if(mysqli_query($GLOBALS['conn'], $sql_MAS)or die( mysqli_error($GLOBALS['conn']))){
                                                        $sql_SOR = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                                    VALUES ('$acc_att_ID','$region_R5','$region_SOR','$male_R5_SOR','$female_R5_SOR')";
                                                                    
                                                        if(mysqli_query($GLOBALS['conn'], $sql_SOR)or die( mysqli_error($GLOBALS['conn']))){
                                                            $sql_OP = "INSERT INTO `acc_attendance`(`acc_att_ID`, `region`, `province`, `male`, `female`) 
                                                                        VALUES ('$acc_att_ID','$region_R5','$region_R5_OP','$male_R5_OP','$female_R5_OP')";
                                                            if(mysqli_query($GLOBALS['conn'], $sql_OP)or die( mysqli_error($GLOBALS['conn']))){
                                                                ?> 
                                                                <script> 
                                                                    alert("Activity has been added succesfully!")
                                                                </script>              
                                                                <?php
                                                                header("Refresh:0; url=accomplishment.php");
                                                            }     
                                                        }           
                                                    } 
                                                } 
                                            }          
                                        }            
                                    }           
                                }        
                            }      
                        }         
                    }    
                }   
            }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=accomplishment.php");
    }

}

function updateData(){
    $id = textboxValue("id");
    $quarter = textboxValue("quarter");
    $project = textboxValue("project");
    $activity = textboxValue("activity");
    $region = textboxValue("region");
    $province = textboxValue("province");
    $track = textboxValue("track");
    $title = textboxValue("title");
    $start_Date = textboxValue("start_Date");
    $end_Date =textboxValue("end_Date");
    $start_Time = textboxValue("start_Time");
    $end_Time = textboxValue("end_Time");
    $mode = textboxValue("mode");
    $type = textboxValue("type");
    $conducted_By = textboxValue("conducted_By");
    $resourse_Person = textboxValue("resourse_Person");
    $remarks = textboxValue("remarks");

    $male = textboxValue("male");
    $female = textboxValue("female"); 
    $senior_Male = textboxValue("senior_Male");
    $senior_Female = textboxValue("senior_Female");
    $pwd_Male = textboxValue("pwd_Male");
    $pwd_Female = textboxValue("pwd_Female");

    $region_R4B = textboxValue("region_R4B");
    $region_ORM = textboxValue("region_ORM");
    $male_R4B_ORM = textboxValue("male_R4B_ORM");
    $female_R4B_ORM = textboxValue("female_R4B_ORM");

    $region_OCM = textboxValue("region_OCM");
    $male_R4B_OCM = textboxValue("male_R4B_OCM");
    $female_R4B_OCM = textboxValue("female_R4B_OCM");

    $region_MAR = textboxValue("region_MAR");
    $male_R4B_MAR = textboxValue("male_R4B_MAR");
    $female_R4B_MAR = textboxValue("female_R4B_MAR");

    $region_ROM = textboxValue("region_ROM");
    $male_R4B_ROM = textboxValue("male_R4B_ROM");
    $female_R4B_ROM = textboxValue("female_R4B_ROM");

    $region_PAL = textboxValue("region_PAL");
    $male_R4B_PAL = textboxValue("male_R4B_PAL");
    $female_R4B_PAL = textboxValue("female_R4B_PAL");

    $region_R5 = textboxValue("region_R5");
    $region_ALB = textboxValue("region_ALB");
    $male_R5_ALB = textboxValue("male_R5_ALB");
    $female_R5_ALB = textboxValue("female_R5_ALB");

    $region_CAM_NOR = textboxValue("region_CAM_NOR");
    $male_R5_CAM_NOR = textboxValue("male_R5_CAM_NOR");
    $female_R5_CAM_NOR = textboxValue("female_R5_CAM_NOR");

    $region_CAM_SUR = textboxValue("region_CAM_SUR");
    $male_R5_CAM_SUR = textboxValue("male_R5_CAM_SUR");
    $female_R5_CAM_SUR = textboxValue("female_R5_CAM_SUR");

    $region_CAT = textboxValue("region_CAT");
    $male_R5_CAT = textboxValue("male_R5_CAT");
    $female_R5_CAT = textboxValue("female_R5_CAT");

    $region_MAS = textboxValue("region_MAS");
    $male_R5_MAS = textboxValue("male_R5_MAS");
    $female_R5_MAS = textboxValue("female_R5_MAS");
    
    $region_SOR = textboxValue("region_SOR");
    $male_R5_SOR = textboxValue("male_R5_SOR");
    $female_R5_SOR = textboxValue("female_R5_SOR");

    $region_R5_OP = textboxValue("region_R5_OP");
    $male_R5_OP = textboxValue("male_R5_OP");
    $female_R5_OP = textboxValue("female_R5_OP"); 
    
    $total = $male + $female + $senior_Male + $senior_Female;
    $days = ((strtotime($end_Date) - strtotime($start_Date))/(60*60*24));
    $duration = ((strtotime($end_Time) - strtotime($start_Time))/(60*60))*$days;
    

    if($quarter && $project && $region && $province && $track && $title && $end_Date && $start_Date && $start_Time && $end_Time && $mode && $type && $conducted_By && $resourse_Person && $remarks){
        
        $sql = "UPDATE  `accomplishment` 
                SET     `quarter`= '$quarter',`project`= '$project',`activity`='$activity',`region`= '$region',`province`= '$province',
                        `track`= '$track',`title`= '$title',`start_Date`= '$start_Date',`end_Date`= '$end_Date',
                        `duration`= '$duration',`start_Time`= '$start_Time',`end_Time`= '$end_Time',`mode`= '$mode',
                        `type`= '$type',`conducted_By`= '$conducted_By',`resourse_Person`= '$resourse_Person',`male`= '$male',
                        `female`= '$female',`senior_Male`= '$senior_Male',`senior_Female`= '$senior_Female',
                        `pwd_Male`= '$pwd_Male',`pwd_Female`= '$pwd_Female',`total`= '$total',`remarks` = '$remarks'
                WHERE id = '$id'";

                if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                    $sql_ORM = "UPDATE `acc_attendance` 
                                SET `region`='$region_R4B',
                                    `province`='$region_ORM',`male`='$male_R4B_ORM',`female`='$female_R4B_ORM' 
                                WHERE acc_att_ID = '$id' AND region = '$region_R4B' AND province = '$region_ORM'";
                
                    if(mysqli_query($GLOBALS['conn'], $sql_ORM)or die( mysqli_error($GLOBALS['conn']))){
                        $sql_OCM = "UPDATE `acc_attendance` 
                                    SET `region`='$region_R4B',
                                        `province`='$region_OCM',`male`='$male_R4B_OCM',`female`='$female_R4B_OCM' 
                                    WHERE acc_att_ID = '$id' AND region = '$region_R4B' AND province = '$region_OCM'";

                        if(mysqli_query($GLOBALS['conn'], $sql_OCM)or die( mysqli_error($GLOBALS['conn']))){
                            $sql_MAR = "UPDATE `acc_attendance` 
                                        SET `region`='$region_R4B',
                                            `province`='$region_MAR',`male`='$male_R4B_MAR',`female`='$female_R4B_MAR' 
                                        WHERE acc_att_ID = '$id' AND region = '$region_R4B' AND province = '$region_MAR'";

                            if(mysqli_query($GLOBALS['conn'], $sql_MAR)or die( mysqli_error($GLOBALS['conn']))){
                                $sql_ROM = "UPDATE `acc_attendance` 
                                            SET `region`='$region_R4B',
                                                `province`='$region_ROM',`male`='$male_R4B_ROM',`female`='$female_R4B_ROM' 
                                            WHERE acc_att_ID = '$id' AND region = '$region_R4B' AND province = '$region_ROM'";

                                if(mysqli_query($GLOBALS['conn'], $sql_ROM)or die( mysqli_error($GLOBALS['conn']))){
                                    $sql_PAL = "UPDATE `acc_attendance` 
                                                SET `region`='$region_R4B',
                                                    `province`='$region_PAL',`male`='$male_R4B_PAL',`female`='$female_R4B_PAL' 
                                                WHERE acc_att_ID = '$id' AND region = '$region_R4B' AND province = '$region_PAL'";

                                    if(mysqli_query($GLOBALS['conn'], $sql_PAL)or die( mysqli_error($GLOBALS['conn']))){
                                        $sql_ALB = "UPDATE `acc_attendance` 
                                                    SET `region`='$region_R5',
                                                        `province`='$region_ALB',`male`='$male_R5_ALB',`female`='$female_R5_ALB' 
                                                    WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_ALB'";

                                        if(mysqli_query($GLOBALS['conn'], $sql_ALB)or die( mysqli_error($GLOBALS['conn']))){
                                            $sql_CAM_NOR = "UPDATE `acc_attendance` 
                                                            SET `region`='$region_R5',
                                                                `province`='$region_CAM_NOR',`male`='$male_R5_CAM_NOR',`female`='$female_R5_CAM_NOR' 
                                                            WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_CAM_NOR'";

                                            if(mysqli_query($GLOBALS['conn'], $sql_CAM_NOR)or die( mysqli_error($GLOBALS['conn']))){
                                                $sql_CAM_SUR = "UPDATE `acc_attendance` 
                                                                SET `region`='$region_R5',
                                                                    `province`='$region_CAM_SUR',`male`='$male_R5_CAM_SUR',`female`='$female_R5_CAM_SUR' 
                                                                WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_CAM_SUR'";

                                                if(mysqli_query($GLOBALS['conn'], $sql_CAM_SUR)or die( mysqli_error($GLOBALS['conn']))){
                                                    $sql_CAT = "UPDATE `acc_attendance` 
                                                                SET `region`='$region_R5',
                                                                    `province`='$region_CAT',`male`='$male_R5_CAT',`female`='$female_R5_CAT' 
                                                                WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_CAT'";

                                                    if(mysqli_query($GLOBALS['conn'], $sql_CAT)or die( mysqli_error($GLOBALS['conn']))){
                                                        $sql_MAS = "UPDATE `acc_attendance` 
                                                                    SET `region`='$region_R5',
                                                                        `province`='$region_MAS',`male`='$male_R5_MAS',`female`='$female_R5_MAS' 
                                                                    WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_MAS'";
                                                                    
                                                        if(mysqli_query($GLOBALS['conn'], $sql_MAS)or die( mysqli_error($GLOBALS['conn']))){
                                                            $sql_SOR = "UPDATE `acc_attendance` 
                                                                        SET `region`='$region_R5',
                                                                            `province`='$region_SOR',`male`='$male_R5_SOR',`female`='$female_R5_SOR' 
                                                                        WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_SOR'";
                                                                        
                                                            if(mysqli_query($GLOBALS['conn'], $sql_SOR)or die( mysqli_error($GLOBALS['conn']))){
                                                                $sql_OP = "UPDATE `acc_attendance` 
                                                                            SET `region`='$region_R5',
                                                                                `province`='$region_R5_OP',`male`='$male_R5_OP',`female`='$female_R5_OP' 
                                                                            WHERE acc_att_ID = '$id' AND region = '$region_R5' AND province = '$region_R5_OP'";

                                                                if(mysqli_query($GLOBALS['conn'], $sql_OP)or die( mysqli_error($GLOBALS['conn']))){
                                                                    ?> 
                                                                    <script> 
                                                                        alert("Activity has been updated succesfully!")
                                                                    </script>              
                                                                    <?php
                                                                    header("Refresh:0; url=accomplishment.php");
                                                                }     
                                                            }           
                                                        } 
                                                    } 
                                                }          
                                            }            
                                        }           
                                    }        
                                }      
                            }         
                        }    
                    } 
                }
    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=accomplishment.php");
    }        
}


function deleteData(){
    $id = textboxValue("id");
    
    
    $sql1 = "DELETE FROM accomplishment WHERE id = '$id'";
    $sql2 = "DELETE FROM acc_attendance WHERE acc_att_ID = '$id'";
    
    if($id){
        
            if(mysqli_query($GLOBALS['conn'], $sql1)or die( mysqli_error($GLOBALS['conn']))){
                if(mysqli_query($GLOBALS['conn'], $sql2)or die( mysqli_error($GLOBALS['conn']))){
                    ?> 
                    <script> 
                        alert("Activity Deleted!")
                    </script>              
                    <?php
                    header("Refresh:0; url=accomplishment.php");
                }
            }
            else{
                ?> 
                <script> 
                    alert("Can't Delete Activity!")
                </script>              
                <?php
                header("Refresh:0; url=accomplishment.php");
            }
       
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=accomplishment.php");
    }    
}

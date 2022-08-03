<?php

include "../../Database/db.php";

$idAC = "";   $quarter = "";  $project = ""; $activity=""; $region = ""; $region1 = ""; $date_accomplished="";  $province = ""; $province1 = ""; $municipality = "";   $specific_Location = "";    $name_Wifi_Site = "";
$site_Type = ""; $cir_Mbps ="";    $access_points = ""; $date_Tested = ""; $activity_Type = ""; $name_Tower = ""; $pow_tor_Status = "";  $date_NOA = ""; $mode = "";
$renovation_Status = ""; $contractor = ""; $estimated_Com_Date = ""; $completion_Date = ""; $connectivity_Status = ""; $name_Agency = "";
$mode = "";  $tech_ass_Prov = "";  $remarks = ""; $cong_District = ""; $GIDA_ELCAC = ""; $date_Conducted_gv = ""; $date_acc_gv = "";
$contract_Type = ""; $pnpki_title = ""; $pnpki_mode = ""; $epbls_status = ""; $epbls_OP = ""; $epbls_Date = ""; $pnpki_date = ""; $delivery_Days="";


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
    
    $quarter = $_POST['quarter'];
    $project = $_POST['project'];
    $activity = $_POST['activity'];
    $region = $_POST['region'];
    $date_accomplished = $_POST['date_accomplished'];
    $province = $_POST['province'];
    $cong_District = $_POST['cong_District'];
    $municipality = $_POST['municipality'];
    $specific_Location = $_POST['specific_Location'];
    $name_Wifi_Site = $_POST['name_Wifi_Site'];
    $site_Type = $_POST['site_Type'];
    $GIDA_ELCAC = $_POST['GIDA_ELCAC'];
    $cir_Mbps = $_POST['cir_Mbps'];
    $access_points = $_POST['access_points'];
    $activity_Type = $_POST['activity_Type'];
    $date_Tested = $_POST['date_Tested'];
    $name_Tower = $_POST['name_Tower'];
    $pow_tor_Status = $_POST['pow_tor_Status'];
    $date_NOA = $_POST['date_NOA'];
    $renovation_Status = $_POST['renovation_Status'];
    $contract_Type = $_POST['contract_Type'];
    $contractor = $_POST['contractor'];
    $estimated_Com_Date = $_POST['estimated_Com_Date'];
    $completion_Date = $_POST['completion_Date'];
    $connectivity_Status = $_POST['connectivity_Status'];
    $name_Agency = $_POST['name_Agency'];
    $mode = $_POST['mode'];
    $date_Conducted_gv = $_POST['date_Conducted_gv'];
    $date_acc_gv = $_POST['date_acc_gv'];
    $tech_ass_Prov = $_POST['tech_ass_Prov'];
    $epbls_status = $_POST['epbls_status'];
    $epbls_OP = $_POST['epbls_OP'];
    $epbls_Date = $_POST['epbls_Date'];
    $pnpki_title = $_POST['pnpki_title'];
    $pnpki_mode = $_POST['pnpki_mode'];
    $pnpki_date = $_POST['pnpki_date'];
    $remarks = $_POST['remarks'];
    $delivery_Days = $_POST['delivery_Days'];
    
    
    if($quarter && $project && $region && $province){
        
            $sql = "INSERT INTO `accomplishment_general`
                                (`id`, `quarter`, `cong_District`, `project`, `activity`, `region`, `date_accomplished`, `province`, `municipality`, `specific_Location`, 
                                `name_Tower`, `name_Wifi_Site`, `name_Agency`, `pow_tor_Status`, `date_NOA`, `delivery_Days`, `estimated_Com_Date`, 
                                `renovation_Status`, `completion_Date`, `contract_Type`, `contractor`, `site_Type`, `GIDA_ELCAC`, `cir_Mbps`, `access_points`, 
                                `date_Tested`, `connectivity_Status`, `activity_Type`, `tech_ass_Prov`, `mode`, `date_Conducted_gv`, `date_acc_gv`, 
                                `pnpki_title`, `pnpki_mode`, `pnpki_date`, `epbls_status`, `epbls_OP`, `epbls_Date`, `remarks`) 

                    VALUES      ('','$quarter','$cong_District','$project','$activity','$region','$date_accomplished',
                                '$province','$municipality','$specific_Location','$name_Tower','$name_Wifi_Site',
                                '$name_Agency','$pow_tor_Status','$date_NOA','$delivery_Days','$estimated_Com_Date',
                                '$renovation_Status','$completion_Date','$contract_Type','$contractor','$site_Type',
                                '$GIDA_ELCAC','$cir_Mbps','$access_points','$date_Tested','$connectivity_Status',
                                '$activity_Type','$tech_ass_Prov','$mode','$date_Conducted_gv','$date_acc_gv',
                                '$pnpki_title','$pnpki_mode','$pnpki_date','$epbls_status','$epbls_OP',
                                '$epbls_Date','$remarks')";    

            if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){

                ?> 
                <script> 
                    alert("Activity has been added succesfully!")
                </script>              
                <?php
                header("Refresh:0; url=accomplishmentGeneral.php");
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
    $id = $_POST['id'];
    $quarter = $_POST['quarter'];
    $project = $_POST['project'];
    $activity = $_POST['activity'];
    $region = $_POST['region'];
    $date_accomplished = $_POST['date_accomplished'];
    $province = $_POST['province'];
    $cong_District = $_POST['cong_District'];
    $municipality = $_POST['municipality'];
    $specific_Location = $_POST['specific_Location'];
    $name_Wifi_Site = $_POST['name_Wifi_Site'];
    $site_Type = $_POST['site_Type'];
    $GIDA_ELCAC = $_POST['GIDA_ELCAC'];
    $cir_Mbps = $_POST['cir_Mbps'];
    $access_points = $_POST['access_points'];
    $activity_Type = $_POST['activity_Type'];
    $date_Tested = $_POST['date_Tested'];
    $name_Tower = $_POST['name_Tower'];
    $pow_tor_Status = $_POST['pow_tor_Status'];
    $date_NOA = $_POST['date_NOA'];
    $renovation_Status = $_POST['renovation_Status'];
    $contract_Type = $_POST['contract_Type'];
    $contractor = $_POST['contractor'];
    $estimated_Com_Date = $_POST['estimated_Com_Date'];
    $completion_Date = $_POST['completion_Date'];
    $connectivity_Status = $_POST['connectivity_Status'];
    $name_Agency = $_POST['name_Agency'];
    $mode = $_POST['mode'];
    $date_Conducted_gv = $_POST['date_Conducted_gv'];
    $date_acc_gv = $_POST['date_acc_gv'];
    $tech_ass_Prov = $_POST['tech_ass_Prov'];
    $epbls_status = $_POST['epbls_status'];
    $epbls_OP = $_POST['epbls_OP'];
    $epbls_Date = $_POST['epbls_Date'];
    $pnpki_title = $_POST['pnpki_title'];
    $pnpki_mode = $_POST['pnpki_mode'];
    $pnpki_date = $_POST['pnpki_date'];
    $remarks = $_POST['remarks'];
    $delivery_Days = $_POST['delivery_Days'];
     

    if($project && $region && $province){
        
        $sql = "UPDATE `accomplishment_general` 
                SET `quarter`='$quarter',`cong_District`='$cong_District',`project`='$project',`activity`='$activity',`region`='$region',`date_accomplished`='$date_accomplished',
                `province`='$province',`municipality`='$municipality',`specific_Location`='$specific_Location',`name_Tower`='$name_Tower',`name_Wifi_Site`='$name_Wifi_Site',
                `name_Agency`='$name_Agency',`pow_tor_Status`='$pow_tor_Status',`date_NOA`='$date_NOA',`delivery_Days`='$delivery_Days',`estimated_Com_Date`='$estimated_Com_Date',
                `renovation_Status`='$renovation_Status',`completion_Date`='$completion_Date',`contract_Type`='$contract_Type',`contractor`='$contractor',`site_Type`='$site_Type',
                `GIDA_ELCAC`='$GIDA_ELCAC',`cir_Mbps`='$cir_Mbps',`access_points`='$access_points',`date_Tested`='$date_Tested',`connectivity_Status`='$connectivity_Status',
                `activity_Type`='$activity_Type',`tech_ass_Prov`='$tech_ass_Prov',`mode`='$mode',`date_Conducted_gv`='$date_Conducted_gv',`date_acc_gv`='$date_acc_gv',
                `pnpki_title`='$pnpki_title',`pnpki_mode`='$pnpki_mode',`pnpki_date`='$pnpki_date',`epbls_status`='$epbls_status',`epbls_OP`='$epbls_OP',
                `epbls_Date`='$epbls_Date',`remarks`='$remarks' 
                WHERE id = '$id'";

                if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                    ?> 
                    <script> 
                        alert("Activity has been updated succesfully!")
                    </script>              
                    <?php
                    header("Refresh:0; url=accomplishmentGeneral.php");
                }
    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=accomplishmentGeneral.php");
    }        
}

function deleteData(){
    $id = $_POST['id'];
    
    
    $sql1 = "DELETE FROM accomplishment_general WHERE id = '$id'";
    
    
    if($id){
        
            if(mysqli_query($GLOBALS['conn'], $sql1)or die( mysqli_error($GLOBALS['conn']))){
               
                    ?> 
                    <script> 
                        alert("Activity Deleted!")
                    </script>              
                    <?php
                    header("Refresh:0; url=accomplishmentGeneral.php");
               
            }
            else{
                ?> 
                <script> 
                    alert("Can't Delete Activity!")
                </script>              
                <?php
                header("Refresh:0; url=accomplishmentGeneral.php");
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


?>
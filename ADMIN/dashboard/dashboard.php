<?php
// Initialize the session
session_start();

$id = $_SESSION["id"];
$username = $_SESSION["username"];
$status = $_SESSION["status"];
$region = $_SESSION["region"];
$province = $_SESSION["province"];
$project = $_SESSION["project"];
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
require "../../Database/db.php";
require "StatusCon.php";
require "dashboardCon.php";
?>


<?php

include "../header/header.php";

?>


<html>
  <head>
    <title>DICT ADMIN PANEL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="dashboard.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=2">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>

  <body>
    

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <form action = "Status.php" method = "get">
    
        <div class="row">
            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">National Broadband Plan</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <?php 
                            $adminTotal = totalApproved($conn,'National Broadband Plan');
                            if($adminTotal == 0){
                                $adminApprovedWidth = 0;
                                $adminPendingWidth = 0;
                                $adminRejectedWidth = 0;
                            }
                            else{
                                $adminCurrentVal = approvedcurrentVal($conn,'National Broadband Plan');
                                
                                $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                            
                                //Pending
                                $adminPendingCurrentVal = pendingCurrentVal($conn,'National Broadband Plan');
                                $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                                
                                $adminRejectedCurrentVal = rejectedCurrentVal($conn,'National Broadband Plan');
                                $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                            }
                            ?>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminCurrentVal ."/". $adminTotal ?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        
                            <div class="row align-items-center mt-2">
                                <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                        
                                            <input type = "submit" class = "btn btn-success" name = "national_approved" id="btn-create" value = "Approved">
                                            <input type = "submit" class = "btn btn-warning" name = "national_pending" id="btn-update" value = "Pending">
                                            <input type = "submit" class = "btn btn-danger" name = "national_rejected" id="btn-delete" value = "Rejected">

                                </div>
                            </div> 
                        
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                    $adminTotal = totalApproved($conn,'Cybersecurity');
                    if($adminTotal == 0){
                        $adminApprovedWidth = 0;
                        $adminPendingWidth = 0;
                        $adminRejectedWidth = 0;
                    }
                    else{
                        $adminCurrentVal = approvedcurrentVal($conn,'Cybersecurity');
                                
                        $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                
                        //Pending
                        $adminPendingCurrentVal = pendingCurrentVal($conn,'Cybersecurity');
                        $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                        //Rejected
                        $adminRejectedCurrentVal = rejectedCurrentVal($conn,'Cybersecurity');
                        $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                    }
                ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">CyberSecurity</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                    
                                    
                                        <input type = "submit" class = "btn btn-success" name = "cyber_approved" id="btn-create" value = "Approved">
                                        <input type = "submit" class = "btn btn-warning" name = "cyber_pending" id="btn-update" value = "Pending">
                                        <input type = "submit" class = "btn btn-danger" name = "cyber_rejected" id="btn-delete" value = "Rejected">
                                    
                            </div>
                        </div>    
                </div>
            </div>

            

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                    $adminTotal = totalApproved($conn,'DJPH');
                    if($adminTotal == 0){
                        $adminApprovedWidth = 0;
                        $adminPendingWidth = 0;
                        $adminRejectedWidth = 0;
                    }
                    else{
                        $adminCurrentVal = approvedcurrentVal($conn,'DJPH');
                                
                        $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                
                        //Pending
                        $adminPendingCurrentVal = pendingCurrentVal($conn,'DJPH');
                        $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                        //Rejected
                        $adminRejectedCurrentVal = rejectedCurrentVal($conn,'DJPH');
                        $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                    }
                ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">DJPH</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                        <input type = "submit" class = "btn btn-success" name = "djph_approved" id="btn-create" value = "Approved">
                                        <input type = "submit" class = "btn btn-warning" name = "djph_pending" id="btn-update" value = "Pending">
                                        <input type = "submit" class = "btn btn-danger" name = "djph_rejected" id="btn-delete" value = "Rejected">
                            
                            </div>
                        </div>    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                        $adminTotal = totalApproved($conn,'DRRM');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'DRRM');
                                
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'DRRM');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'DRRM');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                                
                        
                    ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">DRRM</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                <input type = "submit" class = "btn btn-success" name = "drrm_approved" id="btn-create" value = "Approved">
                                <input type = "submit" class = "btn btn-warning" name = "drrm_pending" id="btn-update" value = "Pending">
                                <input type = "submit" class = "btn btn-danger" name = "drrm_rejected" id="btn-delete" value = "Rejected">
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                    $adminTotal = totalApproved($conn,'eBPLS');
                    if($adminTotal == 0){
                        $adminApprovedWidth = 0;
                        $adminPendingWidth = 0;
                        $adminRejectedWidth = 0;
                    }
                    else{
                        $adminCurrentVal = approvedcurrentVal($conn,'eBPLS');
                                
                        $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                
                        //Pending
                        $adminPendingCurrentVal = pendingCurrentVal($conn,'eBPLS');
                        $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                        //Rejected
                        $adminRejectedCurrentVal = rejectedCurrentVal($conn,'eBPLS');
                        $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                    }
                ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">eBPLS</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "ebpls_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "ebpls_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "ebpls_rejected" id="btn-delete" value = "Rejected">
                            
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                    $adminTotal = totalApproved($conn,'Free Wi-Fi for All');
                    if($adminTotal == 0){
                        $adminApprovedWidth = 0;
                        $adminPendingWidth = 0;
                        $adminRejectedWidth = 0;
                    }
                    else{
                        $adminCurrentVal = approvedcurrentVal($conn,'Free Wi-Fi for All');
                                
                        $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                
                        //Pending
                        $adminPendingCurrentVal = pendingCurrentVal($conn,'Free Wi-Fi for All');
                        $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                        //Rejected
                        $adminRejectedCurrentVal = rejectedCurrentVal($conn,'Free Wi-Fi for All');
                        $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                    }
                ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">Free Wi-Fi for All</h5>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "wifi_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "wifi_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "wifi_rejected" id="btn-delete" value = "Rejected">
                            
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                        $adminTotal = totalApproved($conn,'GAD');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'GAD');
                                
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'GAD');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'GAD');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                                
                        
                    ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">GAD</h5>
                    
                    <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "gad_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "gad_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "gad_rejected" id="btn-delete" value = "Rejected">
                            </div>
                        </div>    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">GOSD</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'GOSD');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'GOSD');
                                
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'GOSD');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'GOSD');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                                
                        
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "gosd_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "gosd_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "gosd_rejected" id="btn-delete" value = "Rejected">
                                   
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">GOVNET</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'GovNet');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'GovNet');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'GovNet');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'GovNet');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "govnet_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "govnet_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "govnet_rejected" id="btn-delete" value = "Rejected">
                               
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">GVCS</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'GVCS');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'GVCS');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'GVCS');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'GVCS');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                    <input type = "submit" class = "btn btn-success" name = "gvcs_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "gvcs_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "gvcs_rejected" id="btn-delete" value = "Rejected">
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">IIDB</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'IIDB');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'IIDB');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'IIDB');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'IIDB');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                    <input type = "submit" class = "btn btn-success" name = "iidb_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "iidb_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "iidb_rejected" id="btn-delete" value = "Rejected">
                            </div>
                        </div>    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">ILCDB</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'ILCDB');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{

                            $adminCurrentVal = approvedcurrentVal($conn,'ILCDB');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'ILCDB');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'ILCDB');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "ilcdb_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "ilcdb_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "ilcdb_rejected" id="btn-delete" value = "Rejected">
                              
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">Information Division</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'Information Division');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'Information Division');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'Information Division');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'Information Division');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "information_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "information_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "information_rejected" id="btn-delete" value = "Rejected">
                             
                            </div>
                        </div>    
                </div>
            </div>

            

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">PNPKI</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'PNPKI');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'PNPKI');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'PNPKI');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'PNPKI');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "pnpki_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "pnpki_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "pnpki_rejected" id="btn-delete" value = "Rejected">
                             
                            </div>
                        </div>    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                <?php 
                        $adminTotal = totalApproved($conn,'Senior Citizens/PWDs');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'Senior Citizens/PWDs');
                                
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'Senior Citizens/PWDs');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'Senior Citizens/PWDs');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                                
                        
                    ?>
                    <h5 class=" heading mt-3 ml-2 mb-2">Senior Citizens/PWDs</h5>
                    <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "senior_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "senior_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "senior_rejected" id="btn-delete" value = "Rejected">
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">Tech4ED</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'Tech4ED');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'Tech4ED');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'Tech4ED');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'Tech4ED');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "tech4ed_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "tech4ed_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "tech4ed_rejected" id="btn-delete" value = "Rejected">
                               
                            </div>
                        </div>    
                </div>
            </div>

            <div class="col d-flex justify-content-center mt-5 mb-4">
                <div class="card p-3">
                    <h5 class=" heading mt-3 ml-2 mb-2">VIMS-IR/VAS</h5>
                    <?php 
                        $adminTotal = totalApproved($conn,'VIMS');
                        if($adminTotal == 0){
                            $adminApprovedWidth = 0;
                            $adminPendingWidth = 0;
                            $adminRejectedWidth = 0;
                        }
                        else{
                            $adminCurrentVal = approvedcurrentVal($conn,'VIMS');
                                    
                            $adminApprovedWidth = ceil(($adminCurrentVal/$adminTotal)*100);
                                    
                            //Pending
                            $adminPendingCurrentVal = pendingCurrentVal($conn,'VIMS');
                            $adminPendingWidth = ceil(($adminPendingCurrentVal/$adminTotal)*100);
                            //Rejected
                            $adminRejectedCurrentVal = rejectedCurrentVal($conn,'VIMS');
                            $adminRejectedWidth = ceil(($adminRejectedCurrentVal/$adminTotal)*100);
                        }
                    ?>
                        <label for="progressbar" class="form-label">Approved</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $adminApprovedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php  echo $adminCurrentVal ."/". $adminTotal?></div>
                        </div>

                        <label for="progressbar" class="form-label">Pending</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $adminPendingWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminPendingCurrentVal ."/". $adminTotal?></div>
                        </div>
                    
                        <label for="progressbar" class="form-label">Rejected</label>
                        <div class="progress mb-2" id =progressbar>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $adminRejectedWidth?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $adminRejectedCurrentVal ."/". $adminTotal?></div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                            
                                    <input type = "submit" class = "btn btn-success" name = "vims_approved" id="btn-create" value = "Approved">
                                    <input type = "submit" class = "btn btn-warning" name = "vims_pending" id="btn-update" value = "Pending">
                                    <input type = "submit" class = "btn btn-danger" name = "vims_rejected" id="btn-delete" value = "Rejected">
                               
                            </div>
                        </div>    
                </div>
            </div>

        </div>
    
    </form>
    

                        
  
  </body>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Send message</button>
      </div>
    </div>
  </div>
</div>

<script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'New message to ' + recipient
    modalBodyInput.value = recipient
    })

</script>

                <?php include '../header/footer.html';?>
            <style>
                <?php include '../header/footer.css';?> 
            </style>
</html>

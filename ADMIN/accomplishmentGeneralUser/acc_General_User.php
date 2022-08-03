<?php
// Initialize the session
session_start();
 
$regionACS = $_SESSION["region"];
$provinceACS = $_SESSION["province"];
$projectACS = $_SESSION["project"];

/*
echo $regionACS;
echo $provinceACS;
echo $projectACS;
*/

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
?>
<?php

//$projectACS = "GovNet";

include "../../Database/db.php";
include "header/header.php";
include "headerAccGenUser/headerAccGenUser.html";
include "acc_General_UserOp.php";


$datatable = "accomplishment_general";
$results_per_page = 5;

$sql_FWTEST = "SELECT COUNT(id) AS total FROM accomplishment_general WHERE name_Tower = '' AND project = 'Free Wi-Fi for All'"; 
$result_FWTEST = $conn->query($sql_FWTEST);
$row_FWTEST = $result_FWTEST->fetch_assoc();
$total_pages_FWTEST = ceil($row_FWTEST["total"] / $results_per_page);

$sql_FW = "SELECT COUNT(id) AS total FROM accomplishment_general WHERE name_Wifi_Site = '' AND project = 'Free Wi-Fi for All'"; 
$result_FW = $conn->query($sql_FW);
$row_FW = $result_FW->fetch_assoc();
$total_pages_FW = ceil($row_FW["total"] / $results_per_page);

$sql_GN = "SELECT COUNT(id) AS total FROM accomplishment_general WHERE  project = 'GovNet' "; 
$result_GN = $conn->query($sql_GN);
$row_GN = $result_GN->fetch_assoc();
$total_pages_GN = ceil($row_GN["total"] / $results_per_page);

$sql_eBPLS = "SELECT COUNT(id) AS total FROM accomplishment_general WHERE  project = 'GovNet' "; 
$result_eBPLS = $conn->query($sql_eBPLS);
$row_eBPLS = $result_eBPLS->fetch_assoc();
$total_pages_eBPLS = ceil($row_eBPLS["total"] / $results_per_page);

$sql_PNPKI = "SELECT COUNT(id) AS total FROM accomplishment_general WHERE  project = 'GovNet' "; 
$result_PNPKI = $conn->query($sql_PNPKI);
$row_PNPKI = $result_PNPKI->fetch_assoc();
$total_pages_PNPKI = ceil($row_PNPKI["total"] / $results_per_page);
  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
    $start_from = ($page-1) * $results_per_page;
    $sql2 = "SELECT * FROM ".$datatable." WHERE name_Tower = '' AND project = 'Free Wi-Fi for All' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    $sql3 = "SELECT * FROM ".$datatable." WHERE name_Wifi_Site = '' AND project = 'Free Wi-Fi for All' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    $sql4  = "SELECT * FROM ".$datatable." WHERE project = 'GovNet' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    $sql5  = "SELECT * FROM ".$datatable." WHERE project = 'eBPLS' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    $sql6  = "SELECT * FROM ".$datatable." WHERE project = 'PNPKI' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
                
    
    



?>

<html>
    <head>
    <link rel="stylesheet" href="acc_General_User2.css" type="text/css">
    
    </head>
    <body>
        <main>          <br><br><br>
                        <div class="row align-items-center mt-2">
                            <div <?php if ($projectACS != "Free Wi-Fi for All") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#FW" aria-expanded="false" aria-controls="collapseTwo">
                                    Free Wi-Fi/NBP
                                </button>  
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#FWTEST" aria-expanded="true" aria-controls="collapseOne"> 
                                List of Inspected and Tested & Accepted WiFi Sites
                                </button>
                            </div>
                            <div <?php if ($projectACS != "GovNet") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#GOVNET" aria-expanded="false" aria-controls="collapseThree">
                                    GovNet
                                </button>
                            </div>
                            <div <?php if ($projectACS != "eBPLS") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#EBPLS" aria-expanded="false" aria-controls="collapseThree">
                                    eBPLS
                                </button>
                            </div>
                            <div <?php if ($projectACS != "PNPKI") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PNPKI" aria-expanded="false" aria-controls="collapseThree">
                                    PNPKI
                                </button>
                            </div>
                        </div> 

            <section>
            <div class="accordion-item">
                <div id="FWTEST" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="panel-body mt-5" style="overflow-x:auto;"> 

                                <table class="table table-bordered"> 
                                    <form action = "acc_General_FWTEST.php" method = "post" class = "form-control" >
                                        </div>
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view">View</button>
                                                    <input type="text" id = "project1" name = "project1" class="form-control" placeholder = "Auto Generated ID" value="Free Wi-Fi for All" hidden >

                                                    
                                            </div>
                                        </div>
                                    
                                            
                                    </form>

                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Activity Type</th>
                                            <th class="header">Project</th>
                                            <th>Region</th>
                                            <th>Province</th>
                                            <th>Congressional District</th>
                                            <th>Municipality</th>                    
                                            <th>Specific Location</th>
                                            <th>Name of Wifi Site</th>
                                            <th>Contract Type</th>
                                            <th>Site Type</th>
                                            <th>GIDA/ELCAC</th>
                                            <th>CIR (MBPS)</th>
                                            <th>Access Points</th>
                                            <th>Date Tested</th>
                                            <th>Quarter</th>
                                            <th>REMARKS</th>

                                        </tr>
                                    

                                    </thead>
                                    <tbody>
                                        <?php   
                                        
                                            $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));; 
                                            
                                            //$sql2 used from search SQL so it can search    
                                            while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                                
                                                <tr id="<?php echo $row['id']; ?>"> 
                                                    <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['activity_Type']; ?>      </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['cong_District']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['municipality']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['specific_Location']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['name_Wifi_Site']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['contract_Type']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['site_Type'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['GIDA_ELCAC'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['cir_Mbps']; echo "Mbps" ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['access_points']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['date_Tested']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>

                                                     
                                                </tr>
                                            <?php 
                                            }
                                            ?>  
                                    </tbody> 
                                    

                                    <center>
                                        <?php
                                            for ($i=1; $i<=$total_pages_FWTEST; $i++) {                                  
                                                echo '<a class="btn btn-warning" href="acc_General_User.php?page='.$i.'">'.$i.'</a>'; 
                                            }; 
                                        ?>                      
                                    </center> 
                                </table>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div id="FW" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="panel-body mt-5" style="overflow-x:auto;"> 
                                <table class="table table-bordered"> 

                                    <form action = "acc_General_FW.php" method = "post" class = "form-control" >
                                        </div>
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view">View</button>
                                                    <input type="text" id = "project1" name = "project1" class="form-control" placeholder = "Auto Generated ID" value="Free Wi-Fi for All" hidden >

                                                    
                                            </div>
                                        </div>
     
                                    </form>

                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="header">Project</th>
                                            <th>Region</th>
                                            <th>Province</th>                      
                                            <th>Name of Provincial POP/Tower</th>
                                            <th>POW/TOR Status</th>                    
                                            <th>Delivery Days</th>
                                            <th>Estimated Date of Completion</th>
                                            <th>Renovation Status</th>
                                            <th>Contractor</th>
                                            <th>Date of Completion</th>
                                            <th>Quarter</th>
                                            <th>REMARKS</th>
                                            
                                            
                                        </tr>
                                    

                                    </thead>
                                    <tbody>
                                        <?php   
                                        
                                            $result  = mysqli_query($conn , $sql3) or die( mysqli_error($conn));; 
                                            
                                            //$sql2 used from search SQL so it can search    
                                            while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                                
                                                <tr id="<?php echo $row['id']; ?>"> 
                                                    <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['name_Tower']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pow_tor_Status']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['delivery_Days']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['estimated_Com_Date']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['renovation_Status']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['contractor'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['completion_Date'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>

                                                     
                                                </tr>
                                            <?php 
                                            }
                                            ?>  
                                    </tbody> 
                                    

                                    <center>
                                        <?php
                                            for ($i=1; $i<=$total_pages_FW; $i++) {                                  
                                                echo '<a class="btn btn-warning" href="acc_General_User.php?page='.$i.'">'.$i.'</a>'; 
                                            }; 
                                        ?>                      
                                    </center> 
                                </table>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div id="GOVNET" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="panel-body mt-5" style="overflow-x:auto;"> 
                                <table class="table table-bordered"> 
                                    <form action = "acc_General_GN.php" method = "post" class = "form-control" >
                                        </div>
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view">View</button>
                                                   
                                            </div>
                                        </div>
     
                                    </form>
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Project</th>
                                            <th class="header">Date Conducted</th>
                                            <th>Date Accomplished</th>
                                            <th>Region</th>
                                            <th>Province</th>
                                            <th>Congressional District</th>
                                            <th>Municipality</th>                    
                                            <th>Specific Location</th>
                                            <th>Name of Connected Agency</th>
                                            <th>Technical Assistance Provided</th>                    
                                            <th>Mode</th>          
                                            <th>Quarter</th>
                                            <th>REMARKS</th>
                                            
                                            
                                        </tr>
                                    

                                    </thead>
                                    <tbody>
                                        <?php   
                                        
                                            $result  = mysqli_query($conn , $sql4) or die( mysqli_error($conn));; 
                                            
                                            //$sql2 used from search SQL so it can search    
                                            while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                                
                                                <tr id="<?php echo $row['id']; ?>"> 
                                                    <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['date_Conducted_gv']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['date_acc_gv']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['cong_District']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['municipality']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['specific_Location']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['name_Agency'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['tech_ass_Prov'];  ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['mode']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>

                                                     
                                                </tr>
                                            <?php 
                                            }
                                            ?>  
                                    </tbody> 
                                    

                                    <center>
                                        <?php
                                            for ($i=1; $i<=$total_pages_GN; $i++) {                                  
                                                echo '<a class="btn btn-warning" href="acc_General_User.php?page='.$i.'">'.$i.'</a>'; 
                                            }; 
                                        ?>                      
                                    </center> 
                                </table>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div id="EBPLS" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="panel-body mt-5" style="overflow-x:auto;"> 
                                <table class="table table-bordered"> 
                                    <form action = "acc_General_eBPLS.php" method = "post" class = "form-control" >
                                        </div>
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view">View</button>
                                                   
                                            </div>
                                        </div>
     
                                    </form>
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Project</th>
                                            <th>Region</th>
                                            <th>Province</th>
                                            <th>Congressional District</th>                         
                                            <th>Status</th>                    
                                            <th>With or Without eBPLS</th>
                                            <th>Date Conducted</th>    
                                            <th>Quarter</th>
                                            <th>REMARKS</th>
                                            
                                            
                                        </tr>
                                    

                                    </thead>
                                    <tbody>
                                        <?php   
                                        
                                            $result  = mysqli_query($conn , $sql5) or die( mysqli_error($conn));; 
                                            
                                            //$sql2 used from search SQL so it can search    
                                            while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                                
                                                <tr id="<?php echo $row['id']; ?>"> 
                                                    <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['cong_District']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['epbls_status']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['epbls_OP']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['epbls_Date']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>

                                                     
                                                </tr>
                                            <?php 
                                            }
                                            ?>  
                                    </tbody> 
                                    

                                    <center>
                                        <?php
                                            for ($i=1; $i<=$total_pages_eBPLS; $i++) {                                  
                                                echo '<a class="btn btn-warning" href="acc_General_User.php?page='.$i.'">'.$i.'</a>'; 
                                            }; 
                                        ?>                      
                                    </center> 
                                </table>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <div id="PNPKI" class="accordion-collapse collapse hide" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="panel-body mt-5" style="overflow-x:auto;"> 
                                <table class="table table-bordered"> 
                                    <form action = "acc_General_PNPKI.php" method = "post" class = "form-control" >
                                        </div>
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view">View</button>
                                                   
                                            </div>
                                        </div>
     
                                    </form>
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Date Conducted</th> 
                                            <th>Project</th>
                                            <th>Region</th>
                                            <th>Province</th>
                                            <th>Title of the Activity</th>
                                            <th>Mode</th>
                                            <th>Quarter</th>
                                            <th>REMARKS</th>
                                            
                                            
                                        </tr>
                                    

                                    </thead>
                                    <tbody>
                                        <?php   
                                        
                                            $result  = mysqli_query($conn , $sql6) or die( mysqli_error($conn));; 
                                            
                                            //$sql2 used from search SQL so it can search    
                                            while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                                
                                                <tr id="<?php echo $row['id']; ?>"> 
                                                    <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_date']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_title']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_mode']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                                    <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>
                                                    

                                                     
                                                </tr>
                                            <?php 
                                            }
                                            ?>  
                                    </tbody> 
                                    

                                    <center>
                                        <?php
                                            for ($i=1; $i<=$total_pages_PNPKI; $i++) {                                  
                                                echo '<a class="btn btn-warning" href="acc_General_User.php?page='.$i.'">'.$i.'</a>'; 
                                            }; 
                                        ?>                      
                                    </center> 
                                </table>                
                        </div>
                    </div>
                </div>
            </div>
                <div class="container">
                    <form method="post" action="acc_General_UserOp.php" enctype="multipart/form-data"> 

                        <div class="row align-items-center mt-2">
                            <div <?php if ($projectACS != "Free Wi-Fi for All") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Free Wi-Fi/NBP
                                </button>
                            
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 
                                List of Inspected and Tested & Accepted WiFi Sites
                                </button>
                            </div>  
                            <div <?php if ($projectACS != "GovNet") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    GovNet
                                </button>
                            </div>
                            <div <?php if ($projectACS != "eBPLS") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    eBPLS
                                </button>
                                </div>
                            <div <?php if ($projectACS != "PNPKI") echo " style='display: none';"; ?>>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    PNPKI
                                </button>
                            </div>
                        </div> 
                        
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-10">

                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $idAC; ?>" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="quarter" class="form-label">Quarter</label>
                                            <select class="form-select"name ="quarter" id="quarter" required >
                                                <option><?php echo $quarter ?></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="project" class="form-label">Select Project</label>
                                        <?php 
                                            $query = "SELECT project FROM project WHERE project = '$projectACS'";
                                            $result = mysqli_query($GLOBALS['conn'], $query);
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                $project .= '<option value="'.$row["project"].'">'.$row["project"].'</option>';
                                            }
                                        ?> 
                                        <select name="project" id="project" class="form-control action">
                                            <option><?php echo $project ?></option>
                                            
                                        </select>
                                    </div>

                                    <div class="col">
                                    <label for="activity" class="form-label">Select Activity</label>
                                        <select name="activity" id="activity" class="form-control action">
                                                <option><?php echo $activity; ?></option>
                                        </select>
                                    </div>

                                    <div class="col">
                                            <label for="region" class="form-label">Select Region</label>
                                                    <?php 
                                                        $query = "SELECT DISTINCT region FROM region GROUP BY region ORDER BY region ASC";
                                                        $result = mysqli_query($GLOBALS['conn'], $query);
                                                        
                                                        while($row = mysqli_fetch_array($result))
                                                        {
                                                            $region1 .= '<option value="'.$row["region"].'">'.$row["region"].'</option>';
                                                        }
                                                    ?> 
                                                    <select name="region" id="region" class="form-control action" required>
                                                        <option><?php echo $region1 ?></option>
                                                        
                                                    </select>
                                    </div>
                                    <div class="col">
                                        <label for="province" class="form-label">Select Province</label>
                                                <select name="province" id="province" class="form-control action" required>
                                                    <option><?php echo $province1 ?></option>
                                                </select>
                                    </div> 
                                </div>
                                
                                <div class="row align-items-center mt-2">
                                    <div class="col"> 
                                        <label for="cong_District" class="form-label">Congressional District</label>
                                            <select class="form-select"name ="cong_District" id="cong_District" required >
                                                <option><?php echo $cong_District ?></option>
                                                <option>1st</option>
                                                <option>2nd</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                        <label for="municipality" class="form-label">Select Municipality</label>
                                            <input type="text" id = "municipality" name = "municipality" class="form-control" value="<?php echo $municipality; ?>">
                                    </div>
                                        <div class="col">
                                        <label for="specific_Location" class="form-label">Specific Location</label>
                                        <input type="text" id = "specific_Location" name = "specific_Location" class="form-control" value="<?php echo $specific_Location; ?>" >
                                    </div>

                                    <div class="col">
                                                    <label for="date_accomplished" class="form-label">Date Accomplished</label>
                                                    <input type="date" class="form-control" name = "date_accomplished" id ="date_accomplished" value="<?php echo $date_accomplished; ?>" >
                                    </div>
                                </div>

                <br>                                       
                            
                                <div class="accordion-item">
    
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                                    <div class="row align-items-center mt-2">
                                                        <div class="col">
                                                        <label for="name_Wifi_Site" class="form-label">Name of Wifi Site</label>
                                                            <input type="text" id = "name_Wifi_Site" name = "name_Wifi_Site" class="form-control" value="<?php echo $name_Wifi_Site; ?>" >
                                                        </div>
                                                        <div class="col">
                                                        <label for="site_Type" class="form-label">Site Type</label>
                                                            <input type="text" id = "site_Type" name = "site_Type" class="form-control" value="<?php echo $site_Type; ?>" >
                                                        </div>
                                                </div>

                                                <div class="row align-items-center mt-2">
                                                    <div class="col">
                                                        <label for="GIDA_ELCAC" class="form-label">GIDA/ELCAC</label>
                                                                <select class="form-select"name ="GIDA_ELCAC" id="GIDA_ELCAC" >
                                                                    <option><?php echo $GIDA_ELCAC ?></option>
                                                                    <option>Yes</option>
                                                                    <option>No</option>
                                                                </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="cir_Mbps" class="form-label">CIR(MBPS)</label>
                                                            <input type="number" id = "cir_Mbps" name = "cir_Mbps" class="form-control" value="<?php echo $cir_Mbps; ?>" >
                                                    </div>

                                                    <div class="col">
                                                        <label for="access_points" class="form-label">Access Points</label>
                                                            <input type="number" id = "access_points" name = "access_points" class="form-control" value="<?php echo $access_points; ?>" >
                                                    </div>
                                                    
                                                    
                                                </div>


                                            
                                                
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                        <label for="activity_Type" class="form-label">Activity Type</label>
                                                        <select class="form-select"name ="activity_Type" id="activity_Type" >
                                                                    <option><?php echo $activity_Type ?></option>
                                                                    <option>Accepted</option>
                                                                    <option>Inspected & Tested</option>
                                                                </select>
                                                    </div>        
                                                <div class="col">
                                                    <label for="date_Tested" class="form-label">Date Inspected/Tested</label>
                                                    <input type="date" id = "date_Tested" name = "date_Tested" class="form-control" value="<?php echo $date_Tested; ?>" >
                                                </div>

       
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row align-items-center mt-4">
                                                <div class="col">
                                                    <label for="name_Tower" class="form-label">Name of Tower</label>
                                                    <input type="text" id = "name_Tower" name = "name_Tower" class="form-control" value="<?php echo $name_Tower; ?>" >
                                                </div>
                                                <div class="col">
                                                    <label for="pow_tor_Status" class="form-label">POW/TOR Statuts</label>
                                                    <input type="text" id = "pow_tor_Status" name = "pow_tor_Status" class="form-control" value="<?php echo $pow_tor_Status; ?>" >
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-2">
                                                <div class="col">
                                                    <label for="date_NOA" class="form-label">Date of NOA</label>
                                                    <input type="date" class="form-control" name = "date_NOA" id ="date_NOA" value="<?php echo $date_NOA; ?>" >
                                                </div>  
                                                <div class="col"> 
                                                    <label for="renovation_Status" class="form-label">Renovation Status</label>
                                                        <select class="form-select"name ="renovation_Status" id="renovation_Status" >
                                                            <option><?php echo $renovation_Status ?></option>
                                                            <option>Ongoing</option>
                                                            <option>Finished</option>
                                                        </select>
                                                </div>                              

                                            </div>

                                            <div class="row align-items-center mt-2">

                                                <div class="col">
                                                <label for="delivery_Days" class="form-label">Delivery Days</label>
                                                
                                                    <input type="text" id = "delivery_Days" name = "delivery_Days" class="form-control" value="<?php echo $delivery_Days; ?>" >
                                                </div>

                                                <div class="col">
                                                <label for="contract_Type" class="form-label">Contract Type</label>
                                                
                                                    <input type="text" id = "contract_Type" name = "contract_Type" class="form-control" value="<?php echo $contract_Type; ?>" >
                                                </div>
                                                <div class="col">
                                                <label for="contractor" class="form-label">Name of Contractor</label>
                                                
                                                    <input type="text" id = "contractor" name = "contractor" class="form-control" value="<?php echo $contractor; ?>" >
                                                </div>
                                            </div>

                                            <div class="row align-items-center mt-2">
                                                
                                                <div class="col">
                                                    <label for="estimated_Com_Date" class="form-label">Estimated Completion Date</label>
                                                    <input type="date" class="form-control" name = "estimated_Com_Date" id ="estimated_Com_Date" value="<?php echo $estimated_Com_Date; ?>" >
                                                </div>

                                                <div class="col">
                                                    <label for="completion_Date" class="form-label">Completion Date</label>
                                                    <input type="date" class="form-control" name = "completion_Date" id ="completion_Date" value="<?php echo $completion_Date; ?>" >
                                                </div>
                                                        
                                            </div>

                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="accordion-item">
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
    
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                    <label for="connectivity_Status" class="form-label">Connectivity Status</label>
                                                    <input type="text" id = "connectivity_Status" name = "connectivity_Status" class="form-control" value="<?php echo $connectivity_Status; ?>" >                
                                                </div>

                                                <div class="col">
                                                    <label for="name_Agency" class="form-label">Name of Connected Agency</label>
                                                    <input type="text" id = "name_Agency" name = "name_Agency" class="form-control" value="<?php echo $name_Agency; ?>">
                                                </div>

                                                <div class="col">
                                                    <label for="mode" class="form-label">Mode</label>
                                                
                                                    <input type="text" id = "mode" name = "mode" class="form-control" value="<?php echo $mode; ?>">
                                                </div>   

                                                                          
                                            </div>
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                    <label for="date_Conducted_gv" class="form-label">Date Conducted</label>
                                                    <input type="date" id = "date_Conducted_gv" name = "date_Conducted_gv" class="form-control" value="<?php echo $date_Conducted_gv; ?>" >                
                                                </div>

                                                <div class="col">
                                                    <label for="date_acc_gv" class="form-label">Date Accomplished</label>
                                                    <input type="date" id = "date_acc_gv" name = "date_acc_gv" class="form-control" value="<?php echo $date_acc_gv; ?>">
                                                </div>
                             
                                            </div>
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                    <label for="tech_ass_Prov" class="form-label">Technical Assistance Provided</label>
                                                    <textarea class="form-control" id="tech_ass_Prov" name = "tech_ass_Prov" rows="2" ><?php echo $tech_ass_Prov; ?></textarea>
                                                </div> 
                                            </div> 
                                               
                                        </div>
                                    </div>
                                </div>  

                                <div class="accordion-item">
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
    
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                    <label for="epbls_status" class="form-label">Status</label>
                                                    <input type="text" id = "epbls_status" name = "epbls_status" class="form-control" value="<?php echo $epbls_status; ?>" >                
                                                </div>

                                                <div class="col">
                                                    <label for="epbls_OP" class="form-label">With or Without eBPLS</label>
                                                    <input type="text" id = "epbls_OP" name = "epbls_OP" class="form-control" value="<?php echo $epbls_OP; ?>">
                                                </div>

                                                <div class="col">
                                                    <label for="epbls_Date" class="form-label">eBpls Date Conducted/Signed</label>
                                                
                                                    <input type="date" id = "epbls_Date" name = "epbls_Date" class="form-control" value="<?php echo $epbls_Date; ?>">
                                                </div>   

                                                                          
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  

                                <div class="accordion-item">
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
    
                                            <div class="row align-items-center mt-2"> 
                                                <div class="col">
                                                    <label for="pnpki_title" class="form-label">Title of Activity</label>
                                                    <input type="text" id = "pnpki_title" name = "pnpki_title" class="form-control" value="<?php echo $pnpki_title; ?>" >                
                                                </div>

                                                <div class="col">
                                                    <label for="pnpki_mode" class="form-label">Mode</label>
                                                    <input type="text" id = "pnpki_mode" name = "pnpki_mode" class="form-control" value="<?php echo $pnpki_mode; ?>">
                                                </div>  
                                                
                                                <div class="col">
                                                    <label for="pnpki_date" class="form-label">Date Conducted</label>
                                                    <input type="date" id = "pnpki_date" name = "pnpki_date" class="form-control" value="<?php echo $pnpki_date; ?>">
                                                </div> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  

                                        

                                <div class="row align-items-center mt-2">
                                    <div class="col"
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="remarks" name = "remarks" rows="5" ><?php echo $remarks; ?></textarea>
                                    </div>
                                </div>
                                        
                                        
                                        
                                <br>
                                <div class="dropdown row justify-content-center mt-2" style ="width:100%; margin:auto;">
                                        
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                Upload Supporting Documents
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
                                                <li <?php if ($projectACS != "Administrative and Finance") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/19ybUwp7mga0ZcyCyqg-tpdRrfxXO2S2m?usp=sharing">Administrative and Finance</a></li>
                                                <li <?php if ($projectACS != "Cybersecurity") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1HrP5Q12j_eIMjHoWxFERfjCAGgJBvKI7?usp=sharing">CyberSecurity</a></li>
                                                <li <?php if ($projectACS != "DICT LC3 Event Pictures/Videos") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1x6D0wCTVqRnzc3qILCUOy2tIwLR96eJd?usp=sharing">DICT LC3 Event Pictures/Videos</a></li>
                                                <li <?php if ($projectACS != "DJPH") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1Q1-QlipbY-51_oDnoz2NUqb4D-rskQPJ?usp=sharing">DJPH</a></li>
                                                <li <?php if ($projectACS != "DRRM") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1YFrY3e0U3IUUXNjOBJG9tPitjNLY3lPk?usp=sharing">DRRM</a></li>
                                                <li <?php if ($projectACS != "eBPLS") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1iPJQACFFwRP_Uy4GpvSzVHE3qC16_6pu?usp=sharing">eBPLS</a></li>
                                                <li <?php if ($projectACS != "Free Wi-Fi for All") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1OtHgmdoCngPLYFbdbN5iF50FJ-aYsYUB?usp=sharing">Free Wi-Fi for All</a></li>
                                                <li <?php if ($projectACS != "GAD") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1T05Q0gBdMKet7kXgDqpKEKL_TiZrdK6T?usp=sharing">GAD</a></li>
                                                <li <?php if ($projectACS != "GOSD") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1roepIUko1_SZmZ7NAfkNQwQKfrDd01Rs?usp=sharing">GOSD</a></li>
                                                <li <?php if ($projectACS != "GovNet") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1-4oDWZsNWLgOwNot6LWOlO8gTCxsrwqR?usp=sharing">GOVNET</a></li>
                                                <li <?php if ($projectACS != "GVCS") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1pvzHhhjUsh4bc3WZSKWy9RWvbCaYGI19?usp=sharing">GVCS</a></li>
                                                <li <?php if ($projectACS != "IIDB") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1qLw5K7O2e36od3TFY1wC97XCN8yS81n9?usp=sharing">IIDB</a></li>
                                                <li <?php if ($projectACS != "ILCDB") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1Kg7n4zhcLpgdvoB__PekKMMXWB5th159?usp=sharing">ILCDB</a></li>
                                                <li <?php if ($projectACS != "Information Division") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1hKch_JBupUhSSqF187_3cdxabUwM7GNH?usp=sharing">Information Division</a></li>
                                                <li <?php if ($projectACS != "MISS") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1aekJorMiFRunBmPtqA0kwHhYGJfJ_dOj?usp=sharing">MISS</a></li>
                                                <li <?php if ($projectACS != "PNPKI") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1T0LsY1bEV6ZWKT0MZAxLeFYUrl1H96XD?usp=sharing">PNPKI</a></li>
                                                <li <?php if ($projectACS != "Senior Citizens/PWDs") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/117uwEg1WrzUMWPBgt_hj8-H-ZppIRjch?usp=sharing">Senior Citizens and PWDs</a></li>
                                                <li <?php if ($projectACS != "Tech4ED") echo " style='display: none';"; ?> ><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1N_63gzBLyBJJTg1Ce5sGMyKripk8ZujU?usp=sharing">Tech4ED</a></li>
                                                <li <?php if ($projectACS != "IMS-IR/VAS") echo " style='display: none';"; ?>><a class="dropdown-item" target="_blank" href="https://drive.google.com/drive/folders/1kPfvg5CdJtxSn1qf2VYyBtpdL5nY9neg?usp=sharing">VIMS-IR/VAS</a></li>
                                            </ul>
                                        
                                </div>
                                    <div class="row align-items-center">
                                        <div class="btn-group mt-1" role="group" aria-label="Basic example">
                                                <button style="width: 100%;" dat-toggle='tooltip' class="btn btn-primary" name = "create" id = "btn-create">Submit</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
        

                                    
        
    </body>

    
    <script>
        $(document).ready(function(){
        $('.action').change(function(){
        if($(this).val() != '')
        {
        var action = $(this).attr("id");
        var query = $(this).val();
        var result = '';
        if(action == "region")
        {
            result = 'province';
        }
        else if(action == 'region1')
        {
            result = 'province1';
        }
        else if(action == 'project'){
            result = 'activity';
        }
        
        $.ajax({
            url:"fetchdata.php",
            method:"POST",
            data:{action:action, query:query},
            success:function(data){
            $('#'+result).html(data);
            }
        })
        }
        });
        }); 

        
    </script>

                <?php include '../header/footer.html';?>
                <style>
                <?php include '../header/footer.css';?> 
            </style>
            

    


    
</html>
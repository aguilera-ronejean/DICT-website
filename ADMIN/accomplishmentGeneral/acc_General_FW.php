<?php


include "../../Database/db.php";
include "../header/header.php";
include "accomplishmentGeneralOp.php";


if(isset($_POST['view'])){
        $project1 = $_POST['project1'];

        $sql2 = "SELECT * FROM accomplishment_general WHERE project = '$project1' AND name_Wifi_Site = '' ";
}
?>
<html>
<head>
    <link rel="stylesheet" href="accPrint.css" type="text/css">
    </head>
    
<body>
<style type="text/css" media="print">


</style>
        <center><button onclick = "window.location.href = 'accomplishmentGeneral.php';" id = "back-btn" class="btn btn-secondary" > Back</button>
                <button onclick = "window.print();" id="print-btn" class="btn btn-primary">Print</button>
        </center>

        <div class="panel-body mt-3" style="overflow-x:auto; margin:auto; width: 95%;">
        
                                <table class="table table-bordered"> 
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
                                    

                                </table>                
        </div>
                  
        
</body>

</html>
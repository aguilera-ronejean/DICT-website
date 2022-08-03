<?php


include "../../Database/db.php";
include "header/header.php";
include "headerAccGenUser/headerAccGenUser.html";
include "acc_General_UserOp.php";


if(isset($_POST['view'])){
        $project1 = $_POST['project1'];

        $sql2 = "SELECT * FROM accomplishment_general WHERE project = '$project1' AND name_Tower = '' ";
}
?>
<html>
<head>
    <title>View</title>
    <link rel="stylesheet" href="accPrint1.css" type="text/css">
    </head>
    
<body>
<style type="text/css" media="print">


</style>
<br><br><br>
        <center><button onclick = "window.location.href = 'acc_General_User.php';" id = "back-btn" class="btn btn-secondary" > Back</button>
                <button onclick = "window.print();" id="print-btn" class="btn btn-primary">Print</button>
        </center>

        <div class="panel-body mt-3" style="overflow-x:auto; background-color: white; margin:auto; width: 95%;">
        
        <table class="table table-bordered"> 
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
                                        
                                            $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));; 
                                            
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
                            
                                </table>                
        </div>
                  
        
</body>
                <?php include 'headerAccGenUser/footer.html';?>
            <style>
                <?php include 'headerAccGenUser/footer1.css';?> 
            </style>
</html>
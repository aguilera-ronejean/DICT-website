<?php


include "../../Database/db.php";
include "header/header.php";
include "headerAccGenUser/headerAccGenUser.html";
include "acc_General_UserOp.php";


if(isset($_POST['view'])){
        

        $sql2 = "SELECT * FROM accomplishment_general WHERE project = 'eBPLS'";
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
                                        
                                            $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));; 
                                            
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
                                    

                                  
                                </table>                              
        </div>
                  
        
</body>

                <?php include 'headerAccGenUser/footer.html';?>
            <style>
                <?php include 'headerAccGenUser/footer1.css';?> 
            </style>

</html>
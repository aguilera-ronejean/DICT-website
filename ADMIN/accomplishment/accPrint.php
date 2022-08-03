<?php


include "../../Database/db.php";
include "../header/header.php";
include "accomplishmentOp.php";


if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $sql2 = "SELECT * FROM accomplishment WHERE id = '$id'";
}
else{
        $sql2 = "SELECT * FROM accomplishment";
}

if(isset($_POST['view'])){
        $region = $_POST['region1'];
        $province = $_POST['province1'];
        

        if((!(empty($region))) && empty($province) ){
                $sql2 = "SELECT * FROM accomplishment WHERE region = '$region'";
        }

        else if(!(empty($region) && empty($province))){
                $sql2 = "SELECT * FROM accomplishment WHERE province = '$province' AND region = '$region'";
        }
        else{
                $sql2 = "SELECT * FROM accomplishment";    
        }
}


?>
<html>
<head>
    <link rel="stylesheet" href="accPrint.css" type="text/css">
    </head>
    
<body>
<style type="text/css" media="print">


</style>
        <center><button onclick = "window.location.href = 'accomplishment.php';" id = "back-btn" class="btn btn-secondary" > Back</button>
                <button onclick = "window.print();" id="print-btn" class="btn btn-primary">Print</button>
        </center>

        <div class="panel-body mt-3" style="overflow-x:auto; margin:auto; width: 95%;">
        <table class="table table-bordered">
        <thead>
                <tr>
                
                <th colspan="27"></th>
                <th class="text-center" colspan="10" style="background-color:#ff94fd">REGION IV-B</th>
                <th class="text-center" colspan="14" style="background-color:#ffbb69">REGION V</th>                                 
                
                </tr>
                <tr>
                <th colspan="20"></th>
                <th style="background-color:#ffff95" class="text-center" colspan="7" style="background-color:#ffff99">TOTAL ATTENDEES</th>
                
                <th style="background-color:#ff94fd" class="text-center" colspan="2">Marinduque</th>
                <th style="background-color:#ff94fd" class="text-center" colspan="2">Occidental Mindoro</th>
                <th style="background-color:#ff94fd" class="text-center" colspan="2">Oriental Mindoro</th>
                <th style="background-color:#ff94fd" class="text-center" colspan="2">Palawan</th>
                <th style="background-color:#ff94fd" class="text-center" colspan="2">Romblon</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Albay</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Sorsogon</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Catanduanes</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Camarines Sur</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Camarines Norte</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Masbate</th>
                <th style="background-color:#ffbb69" class="text-center" colspan="2">Other Provinces</th>
                
                </tr>
                <tr>
                <th class="text-center">ID</th>
                <th>Quarter</th>
                <th class="header">Project</th>
                <th>Region</th>
                <th>Province</th>
                <th>Track</th>
                <th style="background-color:#ffff95">The</th>
                <th style="background-color:#ffff95">Title</th> 
                <th style="background-color:#ffff95">of</th> 
                <th style="background-color:#ffff95">the</th> 
                <th style="background-color:#ffff95" >Activity</th>                       
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Mode</th>
                <th>Type</th>
                
                <th>Conducted By:</th>
                <th>Resource Person</th>
                
                <th style="background-color:#ffff99">Male</th>
                <th style="background-color:#ffff99">Female</th>
                <th style="background-color:#ffff99">Senior Male</th>
                <th style="background-color:#ffff99">Senior Female</th>
                <th style="background-color:#ffff99">PWD Male</th>
                <th style="background-color:#ffff99">PWD Female</th>
                <th style="background-color:#ffff99">Total</th>
                
                <th style="background-color:#ff94fd">Male</th>
                <th style="background-color:#ff94fd">Female</th>
                <th style="background-color:#ff94fd">Male</th>
                <th style="background-color:#ff94fd">Female</th>
                <th style="background-color:#ff94fd">Male</th>
                <th style="background-color:#ff94fd">Female</th>
                <th style="background-color:#ff94fd">Male</th>
                <th style="background-color:#ff94fd">Female</th>
                <th style="background-color:#ff94fd">Male</th>
                <th style="background-color:#ff94fd">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69" >Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
                <th style="background-color:#ffbb69">Male</th>
                <th style="background-color:#ffbb69">Female</th>
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
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>      </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['track']; ?>     </td>
                        <td style="background-color:#ffff95" colspan = "5" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['title']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['start_Date']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['end_Date']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['duration']; echo " Hour/s" ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['start_Time']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['end_Time']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['mode']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['type']; ?>     </td>
                        
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['conducted_By']; ?>     </td>
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['resourse_Person']; ?>     </td>
                        
                        <td style="background-color:#ffff99; text-align:center; " data-id = "<?php echo $row['id']; ?>">    <?php echo $row['male']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center; " data-id = "<?php echo $row['id']; ?>">    <?php echo $row['female']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Male']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Female']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Male']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Female']; ?>     </td>
                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['total']; ?>     </td>
                        
                        <td style="background-color:#ff94fd; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region IV-B' AND province = 'Marinduque' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>

                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 
                        
                                $sql = "SELECT female from acc_attendance WHERE region = 'Region IV-B' AND province = 'Marinduque' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 
                        
                                $sql = "SELECT male from acc_attendance WHERE region = 'Region IV-B' AND province = 'Occidental Mindoro' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>         
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region IV-B' AND province = 'Occidental Mindoro' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region IV-B' AND province = 'Oriental Mindoro' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region IV-B' AND province = 'Oriental Mindoro' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region IV-B' AND province = 'Palawan' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region IV-B' AND province = 'Palawan' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region IV-B' AND province = 'Romblon' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ff94fd ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region IV-B' AND province = 'Romblon' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Albay' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Albay' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Sorsogon' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Sorsogon' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Catanduanes' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Catanduanes' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Camarines Sur' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Camarines Sur' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Camarines Norte' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Camarines Norte' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Masbate' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69 ; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Masbate' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT male from acc_attendance WHERE region = 'Region V' AND province = 'Other Provinces' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['male']; ?>     
                        
                        </td>
                        <td style="background-color:#ffbb69; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php 

                                $sql = "SELECT female from acc_attendance WHERE region = 'Region V' AND province = 'Other Provinces' AND acc_att_ID = '$id'";
                                $result2  = mysqli_query($conn , $sql) or die( mysqli_error($conn));; 
                                $row2  = mysqli_fetch_array($result2);
                                echo $row2['female']; ?>     
                        
                        </td>
                        
        
                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>
                <?php 
                }
                ?>
        </div>
</body>

</html>
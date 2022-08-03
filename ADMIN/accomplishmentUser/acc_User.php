<?php
session_start();
$regionACS = $_SESSION["region"];
$provinceACS = $_SESSION["province"];
$projectACS = $_SESSION["project"];

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

$_SESSION["region"] = $regionACS;
$_SESSION["province"] = $provinceACS;

include "acc_UserOp.php";
include '../accomplishmentUser/header/header.php';
include '../accomplishmentUser/headerAccUser/headerAccUser.html';
  

$datatable = "accomplishment";
$results_per_page = 5;

$sql = "SELECT COUNT(id) AS total FROM ".$datatable." WHERE region = '$regionACS' AND province = '$provinceACS'"; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);



if(isset($_POST['btn-search'])){    //serach buttons function
    $search = $_POST['search'];

    
    
    if($search != ''){

            $sql2 = "SELECT * FROM accomplishment WHERE (id LIKE '%$search%' OR quarter LIKE '%$search%' OR project LIKE '%$search%' OR region LIKE '%$search%' OR province LIKE '%$search%'
                    OR track LIKE '%$search%' OR title LIKE '%$search%' OR start_Date LIKE '%$search%' OR end_Date LIKE '%$search%' OR mode LIKE '%$search%'
                    OR type LIKE '%$search%' OR conducted_By LIKE '%$search%' OR resourse_Person LIKE '%$search%' OR status LIKE '%$search%') AND (region = '$regionACS' AND province = '$provinceACS')";
            $result2 = mysqli_query($GLOBALS['conn'], $sql2);

            if(mysqli_num_rows($result2) == 0){

                ?> 
                <script> 
                    alert("No Data Found!")
                </script>              
                <?php
                
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." WHERE region = '$regionACS' AND province = '$provinceACS' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
            
                
                
                $search = "";
            }
    
    }
    else{
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." WHERE region = '$regionACS' AND province = '$provinceACS' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
        
        $search = "";
    }
}
else{
    
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                $start_from = ($page-1) * $results_per_page;
                $sql2 = "SELECT * FROM ".$datatable." WHERE region = '$regionACS' AND province = '$provinceACS' ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
    
    $search = "";
}
?>

<html>
    <head>
    <link rel="stylesheet" href="acc_User2.css" type="text/css">

    </head>
    <body>
        <main>
            <br><br>

            <section>
        <div class="panel-body mt-5" style="overflow-x:auto;">
                            <table class="table table-bordered">
                                    <form action = "accPrint.php" method = "post" class = "form-control" >    
                                                        <select name="regionACS" id="regionACS" class="form-control" hidden>
                                                            <option><?php echo $regionACS ?></option> </select>

                                                        <select name="provinceACS" id="provinceACS" class="form-control" hidden>
                                                            <option><?php echo $provinceACS ?></option> </select>
                                        
                                        <div class="row align-items-center mb-5" style = "width:50%; margin:auto;">
                                            <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                                    <button dat-toggle='tooltip' class="btn btn-primary" name = "view" id = "btn-view" style="width: 100%;">View All</button>
                                                    
                                            </div>
                                        </div>
                                    </form>
                                <thead>
                                    <tr>
                                        
                                        <th colspan="27"></th>
                                    <?php /*
                                        <th class="text-center" colspan="10" style="background-color:#ff94fd">REGION IV-B</th>
                                        <th class="text-center" colspan="14" style="background-color:#ffbb69">REGION V</th>  
                                    */ ?>                                
                                        
                                    </tr>
                                    <tr>
                                        <th colspan="18"></th>
                                        <th style="background-color:#ffff95" class="text-center" colspan="7" style="background-color:#ffff99">TOTAL ATTENDEES</th>
                                    <?php /*
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
                                    */ ?>   
                                    </tr>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Quarter</th>
                                        <th class="header">Project</th>
                                        <th>Region</th>
                                        <th>Province</th>
                                        <th>Track</th>
                                        <th>The</th>
                                        <th>Title</th> 
                                        <th>of</th> 
                                        <th>the</th> 
                                        <th >Activity</th>                       
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Mode</th>
                                        <th>Type</th>
                                    <?php /*
                                        <th>Conducted By:</th>
                                        <th>Resource Person</th>
                                    */ ?>      
                                        <th style="background-color:#ffff99">Male</th>
                                        <th style="background-color:#ffff99">Female</th>
                                        <th style="background-color:#ffff99">Senior Male</th>
                                        <th style="background-color:#ffff99">Senior Female</th>
                                        <th style="background-color:#ffff99">PWD Male</th>
                                        <th style="background-color:#ffff99">PWD Female</th>
                                        <th style="background-color:#ffff99">Total</th>
                                    <?php /*
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
                                    */ ?>   
                                        <th>REMARKS</th>
                                        <th>ACTIONS</th>
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
                                                <td colspan = "5" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['title']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['start_Date']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['end_Date']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['duration']; echo " Hour/s" ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['start_Time']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['end_Time']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['mode']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['type']; ?>     </td>
                                            <?php /*
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['conducted_By']; ?>     </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['resourse_Person']; ?>     </td>
                                            */ ?>   
                                                <td style="background-color:#ffff99; text-align:center; " data-id = "<?php echo $row['id']; ?>">    <?php echo $row['male']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center; " data-id = "<?php echo $row['id']; ?>">    <?php echo $row['female']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Male']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Female']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Male']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Female']; ?>     </td>
                                                <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['total']; ?>     </td>
                                            <?php /*  
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
                                            */?>
                                    
                                            
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>
                                                <td style="text-align:center">
                                                    <a href="accPrint.php?edit=<?php echo $row["id"]; ?>"><i class="fas fa-eye fa-lg"></i>  
                                                    
                                                    
                                            
                                                </a>
  
                                            </tr>
                                        <?php 
                                        }
                                        ?>    
                                </tbody> 
                                <form action = "acc_User.php" method = "post" class = "form-control searchBox" >
                                    <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto; overflow-x:auto;" value = "<?php echo $search; ?>">
                                    <br>
                                    <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>  <i class="fas fa-search light"> Search</i></button>   </center>
                                </form>

                                <center>
                                    <?php
                                        for ($i=1; $i<=$total_pages; $i++) {                                  
                                            echo '<a class="btn btn-warning" href="accomplishment.php?page='.$i.'">'.$i.'</a>'; 
                                        }; 
                                    ?>                      
                                </center> 
                            </table>                
        </div>
                <div class="container">
                    <form method="post" action="acc_UserOp.php" enctype="multipart/form-data"> 
                
                
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-10">

                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $idAC; ?>" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="quarter" class="form-label">Quarter</label>
                                            <select class="form-select"name ="quarter" id="quarter" required>
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
                                            <?php /*
                                                echo '<select id = "region" name = "region" class = "form-control action" required>
                                                <option selected>'.$region.'</option>
                                                ';
                                                
                                                $sql = "SELECT DISTINCT region FROM region";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) 
                                                {
                                                    echo '<option value = "'.$row['region'].'">'.$row['region'].'</option>';
                                                    
                                                    
                                                }    
                                                echo '</select>';  */

                                                $query = "SELECT DISTINCT region FROM region GROUP BY region ORDER BY region ASC";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    $region .= '<option value="'.$row["region"].'">'.$row["region"].'</option>';
                                                }
                                            ?> 
                                            <select name="region" id="region" class="form-control action" required>
                                                <option><?php echo $region ?></option>
                                                
                                            </select>
                                    </div>
                                    <div class="col">
                                    <label for="province" class="form-label">Select Province</label>
                                            <?php /*
                                                echo '<select id = "province" name = "province" class = "form-control" required>
                                                <option selected>'.$province.'</option>
                                                ';
                                                

                                                    $sql = "SELECT province FROM region";
                                                    $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result)) 
                                                        {
                                                            echo '<option>'.$row['province'].'</option>';
                                                        }
                                                
                                                    echo '</select>';   */
                                            ?>
                                            <select name="province" id="province" class="form-control action" required>
                                                <option><?php echo $province ?></option>
                                            </select>
                                    </div>
                                </div>
                                
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="track" class="form-label">Track</label>
                                        <input type="text" id = "track" name = "track" class="form-control" value="<?php echo $track; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id = "title" name = "title" class="form-control" value="<?php echo $title; ?>" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="start_Date" class="form-label">Select Start Date</label>
                                        <input type="date" class="form-control" name = "start_Date" id ="start_Date" value="<?php echo $start_Date; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="end_Date" class="form-label">Select End Date</label>
                                        <input type="date" class="form-control" name = "end_Date" id ="end_Date" value="<?php echo $end_Date; ?>" required>
                                    </div>

                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="start_Time" class="form-label">Select Start Time</label>
                                        <input type="time" class="form-control" name = "start_Time" id ="start_Time" value="<?php echo $start_Time; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="picture" class="form-label">Select End Time</label>
                                        <input type="time" class="form-control" name = "end_Time" id ="end_Time" value="<?php echo $end_Time; ?>" required>
                                    </div>

                                </div>
                                <div class="row align-items-center mt-2">
                                    
                                    <div class="col"> 
                                        <label for="mode" class="form-label">Mode</label>
                                            <select class="form-select"name ="mode" id="mode" required>
                                                <option><?php echo $mode ?></option>
                                                <option>Online</option>
                                                <option>Face to Face</option>
                                            </select>
                                    </div>
                                    <div class="col">
                                        <label for="type" class="form-label">Type</label>
                                            <select class="form-select"name ="type" id="type" required>
                                                <option><?php echo $type ?></option>
                                                <option>Province-Wide</option>
                                                <option>Cluster-Wide</option>
                                            </select>
                                    </div>
                                    
                                </div>
                                <div class="row align-items-center mt-2">         
                                    <div class="col">
                                        <label for="conducted_By" class="form-label">Conducted by:</label>
                                        <input type="text" id = "conducted_By" name = "conducted_By" class="form-control" value="<?php echo $conducted_By; ?>" required>
                                    </div>
                                    <div class="col">
                                    <label for="resourse_Person" class="form-label">Resource Person</label>
                                        <input type="text" id = "resourse_Person" name = "resourse_Person" class="form-control" value="<?php echo $resourse_Person; ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="remarks" name = "remarks" rows="5" required><?php echo $remarks; ?></textarea>
                                    </div>
                                </div>

                                <br>

                                <div class="row align-items-center mt-2" style ="width:100%; margin:auto;">
                                    <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">First Day Attendance</a>
                                </div>

                                <div id="multiCollapseExample1" class="collapse multi-collapse" style = "border-style: solid; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">    
                                        <div class="row align-items-center mt-2">         
                                                <div class="col">
                                                <label for="senior_Male" class="form-label">Male Senior Attendee/s</label>
                                                    <input type="number" id = "senior_Male" name = "senior_Male" class="form-control" value="<?php echo $senior_Male; ?>" >
                                                </div>
                                                <div class ="col">
                                                    <label for="senior_Female" class="form-label">Female Senior Attendee/s</label>
                                                    <input type="number" id = "senior_Female" name = "senior_Female" class="form-control" value="<?php echo $senior_Female; ?>" >
                                                </div>
                                                <div class="col">
                                                <label for="pwd_Male" class="form-label">Male PWD Attendee/s</label>
                                                    <input type="number" id = "pwd_Male" name = "pwd_Male" class="form-control" value="<?php echo $pwd_Male; ?>" >
                                                </div>
                                                <div class="col">
                                                <label for="pwd_Female" class="form-label">Female PWD Attendee/s</label>
                                                    <input type="number" id = "pwd_Female" name = "pwd_Female" class="form-control" value="<?php echo $pwd_Female; ?>" >
                                                </div>
                                        </div>   
                                    </div>
                                    
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                                <div class="col">
                                                <label for="male" class="form-label">Male Attendee/s</label>
                                                    <input type="number" id = "male" name = "male" class="form-control" value="<?php echo $male; ?>" >
                                                </div>
                                                <div class ="col">
                                                    <label for="female" class="form-label">Female Attendee/s</label>
                                                    <input type="number" id = "female" name = "female" class="form-control" value="<?php echo $female; ?>" >
                                                </div>
                                        </div>   
                                    </div>  
                                </div>

                                <div class="row align-items-center mt-2" style ="width:100%; margin:auto;">
                                    <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">Region IV-B Attendance</a>
                                </div>

                                <div id="multiCollapseExample2" class="collapse multi-collapse" style = "border-style: solid; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                      
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R4B" class="form-label">Region</label>
                                                <input type="text" id = "region_R4B" name = "region_R4B" class="form-control" value="Region IV-B" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_ORM" class="form-label">Province</label>
                                                <input type="text" id = "region_ORM" name = "region_ORM" class="form-control" value="Oriental Mindoro" readonly>                
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <div class="row align-items-center mt-2">         

                                            <div class="col">
                                            <label for="male_R4B_ORM" class="form-label">Male</label>
                                                <input type="number" id = "male_R4B_ORM" name = "male_R4B_ORM" class="form-control" value="<?php echo $male_R4B_ORM; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R4B_ORM" class="form-label">Female</label>
                                                <input type="number" id = "female_R4B_ORM" name = "female_R4B_ORM" class="form-control" value="<?php echo $female_R4B_ORM; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>    
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">                    
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R4B" class="form-label">Region</label>
                                                <input type="text" id = "region_R4B" name = "region_R4B" class="form-control" value="Region IV-B" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_OCM" class="form-label">Province</label>
                                                <input type="text" id = "region_OCM" name = "region_OCM" class="form-control" value="Occidental Mindoro" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R4B_OCM" class="form-label">Male</label>
                                                <input type="number" id = "male_R4B_OCM" name = "male_R4B_OCM" class="form-control" value="<?php echo $male_R4B_OCM; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R4B_OCM" class="form-label">Female</label>
                                                <input type="number" id = "female_R4B_OCM" name = "female_R4B_OCM" class="form-control" value="<?php echo $female_R4B_OCM; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R4B" class="form-label">Region</label>
                                                <input type="text" id = "region_R4B" name = "region_R4B" class="form-control" value="Region IV-B" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_MAR" class="form-label">Province</label>
                                                <input type="text" id = "region_MAR" name = "region_MAR" class="form-control" value="Marinduque" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R4B_MAR" class="form-label">Male</label>
                                                <input type="number" id = "male_R4B_MAR" name = "male_R4B_MAR" class="form-control" value="<?php echo $male_R4B_MAR; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R4B_MAR" class="form-label">Female</label>
                                                <input type="number" id = "female_R4B_MAR" name = "female_R4B_MAR" class="form-control" value="<?php echo $female_R4B_MAR; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R4B" class="form-label">Region</label>
                                                <input type="text" id = "region_R4B" name = "region_R4B" class="form-control" value="Region IV-B" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_ROM" class="form-label">Province</label>
                                                <input type="text" id = "region_ROM" name = "region_ROM" class="form-control" value="Romblon" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R4B_ROM" class="form-label">Male</label>
                                                <input type="number" id = "male_R4B_ROM" name = "male_R4B_ROM" class="form-control" value="<?php echo $male_R4B_ROM; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R4B_ROM" class="form-label">Female</label>
                                                <input type="number" id = "female_R4B_ROM" name = "female_R4B_ROM" class="form-control" value="<?php echo $female_R4B_ROM; ?>" >
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R4B" class="form-label">Region</label>
                                                <input type="text" id = "region_R4B" name = "region_R4B" class="form-control" value="Region IV-B" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_PAL" class="form-label">Province</label>
                                                <input type="text" id = "region_PAL" name = "region_PAL" class="form-control" value="Palawan" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R4B_PAL" class="form-label">Male</label>
                                                <input type="number" id = "male_R4B_PAL" name = "male_R4B_PAL" class="form-control" value="<?php echo $male_R4B_PAL; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R4B_PAL" class="form-label">Female</label>
                                                <input type="number" id = "female_R4B_PAL" name = "female_R4B_PAL" class="form-control" value="<?php echo $female_R4B_PAL; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

                        
                                </div>
                                <div class="row align-items-center mt-2" style ="width:100%; margin:auto;">
                                    <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3">Region V Attendance</a>
                                </div>

                                <div id="multiCollapseExample3" class="collapse multi-collapse" style = "border-style: solid; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                  
                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_ALB" class="form-label">Province</label>
                                                <input type="text" id = "region_ALB" name = "region_ALB" class="form-control" value="Albay" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_ALB" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_ALB" name = "male_R5_ALB" class="form-control" value="<?php echo $male_R5_ALB; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_ALB" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_ALB" name = "female_R5_ALB" class="form-control" value="<?php echo $female_R5_ALB; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_SOR" class="form-label">Province</label>
                                                <input type="text" id = "region_SOR" name = "region_SOR" class="form-control" value="Sorsogon" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_SOR" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_SOR" name = "male_R5_SOR" class="form-control" value="<?php echo $male_R5_SOR; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_SOR" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_SOR" name = "female_R5_SOR" class="form-control" value="<?php echo $female_R5_SOR; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_CAT" class="form-label">Province</label>
                                                <input type="text" id = "region_CAT" name = "region_CAT" class="form-control" value="Catanduanes" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_CAT" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_CAT" name = "male_R5_CAT" class="form-control" value="<?php echo $male_R5_CAT; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_CAT" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_CAT" name = "female_R5_CAT" class="form-control" value="<?php echo $female_R5_CAT; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_CAM_SUR" class="form-label">Province</label>
                                                <input type="text" id = "region_CAM_SUR" name = "region_CAM_SUR" class="form-control" value="Camarines Sur" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_CAM_SUR" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_CAM_SUR" name = "male_R5_CAM_SUR" class="form-control" value="<?php echo $male_R5_CAM_SUR; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_CAM_SUR" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_CAM_SUR" name = "female_R5_CAM_SUR" class="form-control" value="<?php echo $female_R5_CAM_SUR; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_CAM_NOR" class="form-label">Province</label>
                                                <input type="text" id = "region_CAM_NOR" name = "region_CAM_NOR" class="form-control" value="Camarines Norte" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_CAM_NOR" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_CAM_NOR" name = "male_R5_CAM_NOR" class="form-control" value="<?php echo $male_R5_CAM_NOR; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_CAM_NOR" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_CAM_NOR" name = "female_R5_CAM_NOR" class="form-control" value="<?php echo $female_R5_CAM_NOR; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>                   

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_MAS" class="form-label">Province</label>
                                                <input type="text" id = "region_MAS" name = "region_MAS" class="form-control" value="Masbate" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_MAS" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_MAS" name = "male_R5_MAS" class="form-control" value="<?php echo $male_R5_MAS; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_MAS" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_MAS" name = "female_R5_MAS" class="form-control" value="<?php echo $female_R5_MAS; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>

            

                                    <div style = "border-style: ridge; padding: 25px 25px 25px 25px; border-radius: 10px; margin-bottom: 10px;">
                                        <div class="row align-items-center mt-2">         
                                            <div class="col">
                                                <label for="region_R5" class="form-label">Region</label>
                                                <input type="text" id = "region_R5" name = "region_R5" class="form-control" value="Region V" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="region_R5_OP" class="form-label">Province</label>
                                                <input type="text" id = "region_R5_OP" name = "region_R5_OP" class="form-control" value="Other Provinces" readonly>                
                                            </div>
                                            
                                        </div>
                                        <div class="row align-items-center mt-2">         
                                            
                                            
                                            <div class="col">
                                            <label for="male_R5_OP" class="form-label">Male</label>
                                                <input type="number" id = "male_R5_OP" name = "male_R5_OP" class="form-control" value="<?php echo $male_R5_OP; ?>" >
                                            </div>
                                            <div class="col">
                                            <label for="female_R5_OP" class="form-label">Female</label>
                                                <input type="number" id = "female_R5_OP" name = "female_R5_OP" class="form-control" value="<?php echo $female_R5_OP; ?>" >
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div><br>
                                <div class="dropdown row justify-content-center mt-2" style ="width:100%; margin:auto;">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Upload Supporting Documents
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" id = "dropdown">
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
                                                <button dat-toggle='tooltip' class="btn btn-primary" name = "create" id = "btn-create" style="width: 100%;">Submit</button>
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
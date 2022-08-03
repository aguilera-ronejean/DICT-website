<?php
// Initialize the session
session_start();
$projectACS = $_SESSION["project"];

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

include "../../Database/db.php";
include "headerAccUser/headerAccUser.html";
include "header/header.php";

?>

<?php

// Set the default for report type
if(empty($_SESSION['report_type_reportgen'])){
    $report_type = $_SESSION['report_type_reportgen'] = "Summary";
} else{
    $report_type = $_SESSION['report_type_reportgen'];
}

// Set the defaults for category, month and project
if(empty($_SESSION['category_reportgen']) && empty($_SESSION['month_reportgen']) && empty($_SESSION['date_reportgen']) && empty($_SESSION['date1_reportgen']) && empty($_SESSION['project_reportgen'])){
    $category = $_SESSION['category_reportgen'] = 'Select Category';
    $project = $_SESSION['project_reportgen'] = 'Select project';
    $month = $_SESSION['month_reportgen'] = '';
    $date = $_SESSION['date_reportgen'] = '';
    $date1 = $_SESSION['date1_reportgen'] = '';
} else{
    $category = $_SESSION['category_reportgen'];
    $project = $_SESSION['project_reportgen'];
    $month = $_SESSION['month_reportgen'];
    $date = $_SESSION['date_reportgen'];
    $date1 = $_SESSION['date1_reportgen'];
}

// If set button is pressed
if(isset($_GET['set'])){
    $report_type = $_SESSION['report_type_reportgen'] = $_GET['report_type'];
}

if(isset($_GET['generate']) && $report_type == 'Summary'){
    $category = $_SESSION['category_reportgen'] = $_GET['category'];
    $project = $_SESSION['project_reportgen'] = $_GET['project'];
    $month = $_SESSION['month_reportgen'] = $_GET['month'];
    

    list($year, $month_only) = explode("-", $month); 
    if($month_only <= 6){
        $semester = $_SESSION['semester_reportgen'] = "First Semester";
    } else{
        $semester = $_SESSION['semester_reportgen'] = "Second Semester";
    }

    switch($month_only){
        case 1:
            $month_only = "January";
            break;
        case 2:
            $month_only = "February";
            break;
        case 3:
            $month_only = "March";
            break;
        case 4:
            $month_only = "April";
            break;
        case 5:
            $month_only = "May";
            break;
        case 6:
            $month_only = "June";
            break;
        case 7:
            $month_only = "July";
            break;
        case 8:
            $month_only = "August";
            break;
        case 9:
            $month_only = "September";
            break;
        case 10:
            $month_only = "October";
            break;
        case 11:
            $month_only = "November";
            break;
        case 12:
            $month_only = "December";
            break;
    }

    if($semester == "First Semester"){
        $semester_column = 'target_first_sem';
        $semester_condition = '< 7';
    }
    else if($semester == "Second Semester"){
        $semester_column = 'target_second_sem';
        $semester_condition = '> 6';
    }
}

if(isset($_GET['generate']) && $report_type == 'Per Project'){
    $category = $_SESSION['category_reportgen'] = $_GET['category'];
    $project = $_SESSION['project_reportgen'] = $_GET['project'];
    $date = $_SESSION['date_reportgen'] = $_GET['date'];
    $date1 = $_SESSION['date1_reportgen'] = $_GET['date1'];

    $period_condition_training = "AND DATE(`end_Date`) BETWEEN '$date' AND '$date1'";
    $period_condition_general =  "AND DATE(date_accomplished) BETWEEN '$date' AND '$date1'";
}

// If generate button is pressed
if(isset($_GET['generate'])){
    if($project == 'All Projects'){
        $project_condition = "WHERE 1";
    } else{
        $project_condition = "WHERE project = '$project'";
    }
}

if(isset($_GET['generate']) && $report_type == 'Summary'){
$sql2 = "SELECT * FROM
(

SELECT id, project, activity, performance_indicator, target_forthesemester, target_month, variance, variance_month, issues, remarks, accomplishment_sem, accomplishment_month, total_attendee, male, female FROM 

(SELECT project AS project_training_variance, activity AS activity_training_variance, VARIANCE(accomplishment_month) AS variance_month FROM
(SELECT project, activity, COUNT(id) as accomplishment_month
FROM `accomplishment` 
WHERE YEAR(`end_Date`)='$year' AND MONTHNAME(`end_Date`) = '$month_only' 
GROUP BY project, activity, end_Date)tmp
GROUP BY project_training_variance, activity_training_variance) AS training_variance

INNER JOIN
(SELECT project AS project_training_accomplishment_month, activity AS activity_training_accomplishment_month, COUNT(id) as accomplishment_month, SUM(`male` + `female`) AS total_attendee, SUM(male) AS male, SUM(female) AS female
FROM `accomplishment` 
WHERE YEAR(`end_Date`)='$year' AND MONTHNAME(`end_Date`) = '$month_only' 
GROUP BY project, activity) AS training_accomplishment_month
ON training_variance.project_training_variance=training_accomplishment_month.project_training_accomplishment_month

RIGHT JOIN
(SELECT report.id, report.project, report.activity, report.performance_indicator, target.`$semester_column` AS target_forthesemester, target.target_month, report.variance, report.issues, report.remarks
FROM  report 
LEFT JOIN target
ON report.id = target.report_id AND target.year = '$year'
WHERE report.activity_type='Training') AS training_report
ON training_report.project = training_accomplishment_month.project_training_accomplishment_month AND training_report.activity = training_accomplishment_month.activity_training_accomplishment_month
        
LEFT JOIN
(SELECT project AS project_training_accomplishment_sem, activity AS activity_training_accomplishment_sem, COUNT(id) as accomplishment_sem 
FROM `accomplishment` 
WHERE YEAR(`end_Date`)='$year' AND MONTH(`end_Date`) $semester_condition 
GROUP BY project, activity) AS training_accomplishment_sem
ON training_report.project = training_accomplishment_sem.project_training_accomplishment_sem AND training_report.activity = training_accomplishment_sem.activity_training_accomplishment_sem        


UNION ALL


SELECT id, project, activity, performance_indicator, target_forthesemester, target_month, variance, variance_month, issues, remarks, accomplishment_sem, accomplishment_month, null, null, null FROM 
(SELECT project AS project_general_variance, activity AS activity_general_variance, VARIANCE(accomplishment_month) AS variance_month FROM
(SELECT project, activity, COUNT(id) as accomplishment_month
FROM `accomplishment_general` 
WHERE YEAR(date_accomplished)='$year' AND MONTHNAME(date_accomplished) = '$month_only' 
GROUP BY project, activity, date_accomplished)tmp1
GROUP BY project_general_variance, activity_general_variance) AS general_variance

INNER JOIN
(SELECT project AS project_general_accomplishment_month, activity AS activity_general_accomplishment_month, COUNT(id) as accomplishment_month, date_accomplished 
FROM `accomplishment_general` 
WHERE YEAR(date_accomplished)='$year' AND MONTHNAME(date_accomplished)='$month_only' 
GROUP BY project, activity) AS general_accomplishment_month
ON general_variance.project_general_variance=general_accomplishment_month.project_general_accomplishment_month
        
RIGHT JOIN
(SELECT report.id, report.project, report.activity, report.performance_indicator, target.`$semester_column` AS target_forthesemester, target.target_month, report.variance, report.issues, report.remarks
FROM  report 
LEFT JOIN target
ON report.id = target.report_id AND target.year = '$year'
WHERE report.activity_type='General') AS general_report
ON general_report.project = general_accomplishment_month.project_general_accomplishment_month AND general_report.activity = general_accomplishment_month.activity_general_accomplishment_month
        
LEFT JOIN
(SELECT project AS project_general_accomplishment_sem, activity AS activity_general_accomplishment_sem, COUNT(id) as accomplishment_sem, date_accomplished 
FROM `accomplishment_general` 
WHERE YEAR(date_accomplished)='$year'  AND MONTH(date_accomplished) $semester_condition 
GROUP BY project, activity) AS general_accomplishment_sem
ON general_report.project = general_accomplishment_sem.project_general_accomplishment_sem AND general_report.activity = general_accomplishment_sem.activity_general_accomplishment_sem        


)report_generated

$project_condition
ORDER BY project, activity;";
}

?>

<html>
    <head>
    <title>Report Generation</title>
    <link rel="stylesheet" href="reportgeneration1.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="get" action="">
            <div class="row justify-content-center">
                <div class="row align-items-center mt-4">
                    <div class="col">
                        <label for="report_type" class="form-label">Report Type</label>
                            <select class="form-select" name="report_type" id="report_type" required>
                                <option selected><?php echo $report_type; ?></option>
                                <option>Summary</option>
                                <option>Per Project</option>
                            </select>
                    </div>
                    <div class="col">
                        <label for="set" class="form-label mt-3"></label>
                        <input type="submit" name="set" class="form-control" value="Set">
                    </div>
                </div>
            </div>
            </form>
        </div>
        <main>
            <section>
                <div class="container">
                    <form method="get" action="" enctype="multipart/form-data"> 
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">

                                <div class="row align-items-center mt-4">
                                    <div class="col text-left">
                                        <label for="category" class="form-label">Category:</label>
                                        <select class="form-select" name="category" id="category" required>
                                            <option selected>Select Category</option>
                                            <?php if($report_type == 'Summary'){?>
                                            <option>Both</option>
                                            <option>Accomplishment</option>
                                            <option>Target</option>
                                            <?php } elseif($report_type == 'Per Project'){?>
                                            <option>General Accomplishment</option>
                                            <option>Training Accomplishment</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                
                                <!--div class="row align-items-center mt-3">
                                    <div class="col text-left">
                                        <p>Period:</p>
                                    </div>
                                </div-->

                                <div class="row align-items-center mt-3">
                                    <!--div class="col">
                                        <label for="datepicker" class="form-label">Year:</label>
                                        <input type="number" id = "datepicker" name = "datepicker" class="form-control" value="<?php //echo $year; ?>" required>
                                    </div-->
                                    <div class="col">
                                        <?php if($report_type == 'Summary'){ ?>
                                        <label for="month" class="form-label">Month:</label>
                                            <input type="month" name="month" class="form-control" value="<?php echo $month; ?>">
                                        <?php } elseif($report_type == 'Per Project'){ ?>
                                            <label for="date" class="form-label">Period:</label>
                                            <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
                                            <input type="date" name="date1" class="form-control" value="<?php echo $date1; ?>">
                                        <?php } ?>        
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col text-left">
                                        <label for="project" class="form-label">Project:</label>
                                                <select id = "project" name = "project" class = "form-control" required>
                                                <option selected>Select Project</option>;
                                                </select>
                                    </div>   
                                </div>
                                
                                <div class="row align-items-center mt-2">
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                            <button dat-toggle='tooltip' class="btn btn-primary" name = "generate" value="generate" id = "btn-view">Generate</button>
                                    </div>
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                        <?php date_default_timezone_set('Asia/Manila'); $filename = 'report - ' . date('Y-n-j--G-i-s'); ?> 
                                        <button type="button" dat-toggle='tooltip' class="btn btn-primary" onclick="ExportToExcel('xlsx', '<?php echo $filename.'.xlsx'; ?>','')">Export To Excel File</button>
                                    </div>
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                        <button type="button" dat-toggle='tooltip' class="btn btn-primary" onclick="createPDF()">Export To Pdf File</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
        
        <?php if(isset($_GET['generate'])){ ?>
            <div class="panel-body mt-5" style="overflow-x:auto;">
                <div id="reporttable">
                    <table id="tblData" class="table table-bordered">
                    <?php if($report_type == 'Summary'){ ?>
                        <thead>
                            <tr>
                                <th colspan="10" style = "text-align: center;"><img src="image1.png"/></th>
                            </tr>
                            <tr>
                                <th colspan="10">Agency: Department of Information and Communications Technology</th>
                            </tr>
                            <tr>
                                <th colspan="10">Regional Cluster: Luzon 3 Cluster</th>
                            </tr>
                            <tr>
                                <th colspan="10">Period Covered: <?php echo " $month_only $year"; ?></th>
                            </tr>
                            <tr>
                                <th>Project</th>
                                <th>Activity</th>
                                <th>Performance Indicator</th>
                                <?php if($category=='Both' || $category=='Target'){ ?>
                                <th>Cumulative Target for the <?php echo " $semester"; ?></th>
                                <?php } ?>
                                <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                <th>Cumulative Accomplishment for the <?php echo " $semester"; ?></th>
                                <?php } ?>
                                <?php if($category=='Both' || $category=='Target'){ ?>
                                <th>Physical Target for the Month</th>
                                <?php } ?>
                                <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                <th>Accomplishment for the Month</th>
                                <?php } ?>
                                <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                <th>Variance</th>
                                <th>Issues</th>
                                <th class="column_remarks">Remarks</th>
                                <?php } ?>
                                <!--th class="text-center" style="width: 100px;">Actions</th-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));;    //$sql2 used from search SQL so it can search
                                list($semester, $semester1) = explode(" ", $semester);  
                                while($row  = mysqli_fetch_array($result)){ ?>
                                    
                                    <tr id="<?php echo $row['id']; ?>">

                                        <!--td style="text-align:center" data-id = "<?php /*echo $row['id']; ?>">    <?php echo $row['id']; */?>   </td-->
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['project']; ?>  </td>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['activity']; ?>   </td>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['performance_indicator']; ?>   </td>
                                        <?php if($category=='Both' || $category=='Target'){ ?>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['target_forthesemester']; ?>   </td>
                                        <?php } ?>
                                        <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['accomplishment_sem']; ?>    </td>
                                        <?php } ?>
                                        <?php if($category=='Both' || $category=='Target'){ ?>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['target_month']; ?>   </td>
                                        <?php } ?>
                                        <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['accomplishment_month']; ?>  </td>
                                        <?php } ?>
                                        <?php if($category=='Both' || $category=='Accomplishment'){ ?>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['variance']."\n".$row['variance_month']; ?>  </td>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['issues']; ?>   </td>
                                        <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['remarks'].($row['total_attendee'] != '' ? "<br>Total - ".$row['total_attendee']."<br>Male - ".$row['male']."<br>Female - ".$row['female'] : ''); ?>  </td>   
                                        <?php } ?>
                                    </tr>
                                <?php } ?>    
                        </tbody>
                        <!--form action = "reportgeneration.php" method = "post" class = "form-control searchBox" >
                            <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto; overflow-x:auto;" value = "<?php echo $search; ?>">
                            <br>
                            <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>  <i class="fas fa-search light"> Search</i></button>   </center>
                        </form>

                        <center>
                            <?php /*
                                for ($i=1; $i<=$total_pages; $i++) {                                  
                                    echo '<a class="btn btn-warning" href="reportgeneration.php?page='.$i.'">'.$i.'</a>'; 
                                }; 
                            */?>                      
                        </center> <br-->
                </div>
            <?php } elseif($report_type == 'Per Project'){ ?>
                <?php if($category == 'Training Accomplishment'){ ?>

                    <?php $sql2 = "SELECT * FROM accomplishment $project_condition $period_condition_training"; ?>
                        <thead>
                                <tr>
                                    <th colspan="17"></th>
                                    <th style="background-color:#ffff95" class="text-center" colspan="7" style="background-color:#ffff99">TOTAL ATTENDEES</th>
                                    <th></th>
                                </tr>
                                <tr>
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
                                    <th style="background-color:#ffff99">Male</th>
                                    <th style="background-color:#ffff99">Female</th>
                                    <th style="background-color:#ffff99">Senior Male</th>
                                    <th style="background-color:#ffff99">Senior Female</th>
                                    <th style="background-color:#ffff99">PWD Male</th>
                                    <th style="background-color:#ffff99">PWD Female</th>
                                    <th style="background-color:#ffff99">Total</th>
                                    <th>REMARKS</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php   
                                $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));
    
                                while($row  = mysqli_fetch_array($result)){ $id = $row['id']; ?>
                                    <tr id="<?php echo $row['id']; ?>"> 
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
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['male']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['female']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Male']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['senior_Female']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Male']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pwd_Female']; ?>     </td>
                                        <td style="background-color:#ffff99; text-align:center;" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['total']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td>
                                    </tr>
                                <?php } ?>
                        </tbody>                
                <?php } elseif($category == 'General Accomplishment'){ ?>
                    <?php if($project == 'List of inspected and Tested & Accepted WiFi Sites'){ 
                        $sql2 = "SELECT * FROM accomplishment_general WHERE name_Tower = '' AND project = 'Free Wi-Fi for All' $period_condition_general";?> 
                            <thead>
                                <tr>
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
                                    <?php } ?>  
                            </tbody>
                    <?php } elseif($project == 'Free Wi-fi/NBP'){
                        $sql3 = "SELECT * FROM accomplishment_general WHERE name_Wifi_Site = '' AND project = 'Free Wi-Fi for All' $period_condition_general";?>
                        <thead>
                                        <tr>
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
                                            <?php } ?>  
                                    </tbody>
                    <?php } elseif($project == 'GovNet'){
                        $sql4  = "SELECT * FROM accomplishment_general WHERE project = 'GovNet' $period_condition_general";?>
                        <thead>
                                <tr>
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
                                    <?php } ?>  
                            </tbody> 
                    <?php } elseif($project == 'eBPLS'){
                        $sql5  = "SELECT * FROM accomplishment_general WHERE project = 'eBPLS' $period_condition_general";?>
                        <thead>
                                <tr>
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
                                    <?php } ?>  
                            </tbody>
                    <?php } elseif($project == 'PNPKI'){
                        $sql6  = "SELECT * FROM accomplishment_general WHERE project = 'PNPKI' $period_condition_general"; ?>
                         <thead>
                            <tr>
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
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_date']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['region']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['province']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_title']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['pnpki_mode']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['quarter']; ?>     </td>
                                        <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['remarks']; ?>     </td> 
                                    </tr>
                                <?php } ?>  
                        </tbody>
                    <?php } ?>
                <?php } ?>         
            <?php } ?>
            </table>
            </div>
        </div>
        <?php } ?>


        <?php include '../header/footer.html';?>
        <style>
            <?php include '../header/footer.css';?> 
        </style>

</body>
   

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(picture);
});
</script>

<?php
    $sql = "SELECT project FROM project WHERE project='$projectACS'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        $array[] = $row; // Inside while loop
    }
    foreach($array as $x){
        $final_array[] = $x[0];
    }
    $javascript_array = json_encode($final_array);
?>
<script>
    // Dependent drop-down list
    var categoryObject = {
    "Both" : <?php echo $javascript_array; ?>,
    "Accomplishment" : <?php echo $javascript_array; ?>,
    "Target" : <?php echo $javascript_array; ?>,
    "Training Accomplishment" : <?php echo $javascript_array; ?>,
    "General Accomplishment": [
        <?php if($projectACS == 'Free Wi-Fi for All'){ ?>
        'Free Wi-fi/NBP',
        'List of inspected and Tested & Accepted WiFi Sites',
        <?php } ?>
        <?php if($projectACS == 'GovNet'){ ?>
        'GovNet',
        <?php } ?>
        <?php if($projectACS == 'eBPLS'){ ?>
        'eBPLS',
        <?php } ?>
        <?php if($projectACS == 'PNPKI'){ ?>
        'PNPKI'
        <?php } ?>
        ]
    }
    window.onload = function() {
        var categorySel = document.getElementById("category");
        var projectSel = document.getElementById("project");
        categorySel.onchange = function() {
            projectSel.length = 1;
            var z = categoryObject[this.value];
            for (var i = 0; i < z.length; i++) {
            projectSel.options[projectSel.options.length] = new Option(z[i], z[i]);
            }
        }
    }
</script>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tblData');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }
</script>

<script>
    function createPDF() {
        var sTable = document.getElementById('reporttable').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        //win.document.write('<title>Report Generated</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
</script>

</html>
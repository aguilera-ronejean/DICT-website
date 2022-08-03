<?php
include "../../Database/db.php";
include "reporttemplateOp.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}

// Header
include "../header/header.php";


?>


<?php

// Set the year and semester
if(empty($_SESSION['year_reporttemplate'])){
    $year = $_SESSION['year_reporttemplate'] = date('Y');
}else{
    $year = $_SESSION['year_reporttemplate'];
}
if(isset($_GET['set'])){
    $year = $_SESSION['year_reporttemplate'] = $_GET['datepicker'];
}



if (isset($_GET['edit'])) {     // puts selected row into textbox for it to be editted/deleted
    $id = $_GET['edit'];
    $project = $_GET['project'];
    $activity = $_GET['activity'];
    $performance_indicator = $_GET['performance_indicator'];
    $edit_state = true;
    

    $sql = "SELECT report.id, report.project, report.activity, report.activity_type, report.performance_indicator, 
            target.target_first_sem, target.target_second_sem, target.target_month, report.variance, report.issues, report.remarks
            FROM report
            LEFT JOIN target
            ON report.id = target.report_id AND target.year='$year' 
            WHERE report.id = '$id'";

    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    
    $id = $row['id'];
    $project = $row['project'];
    $activity = $row['activity'];
    $activity_type = $row['activity_type'];
    $performance_indicator = $row['performance_indicator'];
    $target_first_sem = $row['target_first_sem'];
    $target_second_sem = $row['target_second_sem'];
    $target_month = $row['target_month'];
    $variance = $row['variance'];
    $issues = $row['issues'];
    $remarks = $row['remarks'];
    
}

$datatable = "report";
$results_per_page = 10;

$sql = "SELECT COUNT(id) AS total FROM ".$datatable; 
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);


if(isset($_POST['btn-search'])){    //serach buttons function
    $search = $_POST['search'];

    
    if($search != ''){

            $sql2 = "SELECT report.id, report.project, report.activity, report.activity_type, report.performance_indicator, 
                    target.target_first_sem, target.target_second_sem, target.target_month, report.variance, report.issues, report.remarks
                    FROM report
                    LEFT JOIN target
                    ON report.id = target.report_id  AND target.year='$year'
                    WHERE report.id LIKE '%$search%' OR report.project LIKE '%$search%' OR report.activity LIKE '%$search%' OR report.activity_type LIKE '%$search%' OR report.performance_indicator LIKE '%$search%' OR
                    target.target_first_sem LIKE '%$search%' OR target.target_second_sem LIKE '%$search%' OR target_month LIKE '%$search%' OR variance LIKE '%$search%' OR issues LIKE '%$search%' OR remarks LIKE '%$search%'
                    ORDER BY report.project, report.activity, report.activity_type";
            $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($conn));

            if(mysqli_num_rows($result2) == 0){

                ?> 
                <script> 
                    alert("No Data Found!")
                </script>              
                <?php

                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                    $start_from = ($page-1) * $results_per_page;
                    $sql2 = "SELECT report.id, report.project, report.activity, report.activity_type, report.performance_indicator, 
                            target.target_first_sem, target.target_second_sem, target.target_month, report.variance, report.issues, report.remarks
                            FROM report
                            LEFT JOIN target
                            ON report.id = target.report_id AND target.year='$year'
                            ORDER BY report.project, report.activity, report.activity_type
                            LIMIT $start_from, ".$results_per_page;

                $search = "";
            }
    
    }
    else{
        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
        $start_from = ($page-1) * $results_per_page;
        $sql2 = "SELECT report.id, report.project, report.activity, report.activity_type, report.performance_indicator, 
                target.target_first_sem, target.target_second_sem, target.target_month, report.variance, report.issues, report.remarks
                FROM report
                LEFT JOIN target
                ON report.id = target.report_id AND target.year='$year'
                ORDER BY report.project, report.activity, report.activity_type
                LIMIT $start_from, ".$results_per_page;
        $search = "";
    }
}
else{
    
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
    $start_from = ($page-1) * $results_per_page;
    $sql2 = "SELECT report.id, report.project, report.activity, report.activity_type, report.performance_indicator,
            target.target_first_sem, target.target_second_sem, target.target_month, report.variance, report.issues, report.remarks
            FROM report
            LEFT JOIN target
            ON report.id = target.report_id AND target.year='$year'
            ORDER BY report.project, report.activity, report.activity_type, performance_indicator
            LIMIT $start_from, ".$results_per_page;
    $search = "";
}
?>

<html>
    <head>
    <title>Report Template</title>
    <link rel="stylesheet" href="reporttemplate.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <form method="get" action="">
            <div class="row justify-content-center">
                <div class="row align-items-center mt-4">
                    <div class="col">
                        <label for="datepicker" class="form-label">Year</label>
                        <input type="text" id="datepicker" name="datepicker" class="form-control" value="<?php echo $year; ?>">
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
                    <form method="post" action="reporttemplateOp.php" enctype="multipart/form-data"> 
                
                
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">

                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">Report ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $id; ?>" readonly>
                                    </div>
                                    <div class="col">
                                    <label for="project" class="form-label">Select Project</label>
                                            <?php
                                                echo '<select id = "project" name = "project" class = "form-control" required>
                                                <option selected>'.$project.'</option>
                                                ';
                                                
                                                $sql = "SELECT project FROM project";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) 
                                                {
                                                    echo '<option>'.$row['project'].'</option>';
                                                }    
                                                echo '</select>';
                                            ?>
                                    </div>
                                </div>
                                
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="activity" class="form-label">Planned Activity</label>
                                        <input type="text" id="activity" name="activity" class="form-control" value="<?php echo $activity; ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="activity_type" class="form-label">Activity Type</label>
                                        <select id="activity_type" name="activity_type" class="form-control" required>
                                            <option selected><?php echo $activity_type; ?></option>
                                            <option>General</option>
                                            <option>Training</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="performance_indicator" class="form-label">Performance Indicator</label>
                                        <input type="textbox" id = "performance_indicator" name = "performance_indicator" class="form-control" value="<?php echo $performance_indicator; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="target_first_sem" class="form-label">Target for the First Semester</label>
                                        <input type="text" id = "target_first_sem" name = "target_first_sem" class="form-control" value="<?php echo $target_first_sem; ?>">
                                    </div>
   
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="target_second_sem" class="form-label">Target for the Second Semester</label>
                                        <input type="text" id = "target_second_sem" name = "target_second_sem" class="form-control" value="<?php echo $target_second_sem; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="target_month" class="form-label">Physical Target for the Month</label>
                                        <input type="text"  id = "target_month" name = "target_month" class="form-control" value="<?php echo $target_month; ?>">
                                    </div>       
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="variance" class="form-label">Variance</label>
                                        <input type="text" id = "username" name = "variance" class="form-control" value="<?php echo $variance; ?>">
                                    </div>
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="issues" class="form-label">Issues</label>
                                        <textarea class="form-control" id="issues" name = "issues" rows="2"><?php echo $issues; ?></textarea>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="col">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea class="form-control" id="remarks" name = "remarks" rows="3"><?php echo $remarks; ?></textarea>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-2">
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                            <button dat-toggle='tooltip' class="btn btn-primary" name = "create" id = "btn-create">Add</button>
                                            <button dat-toggle='tooltip' class="btn btn-warning"name = "update" id = "btn-update">Update</button>
                                            <button dat-toggle='tooltip' class="btn btn-danger"name = "delete" id = "btn-delete" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <div class="panel-body mt-5" style="overflow-x:auto;">
            
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Project</th>
                                        <th>Planned Activity</th>
                                        <th>Activity Type</th>
                                        <th>Performance Indicator</th>
                                        <th>Target for the First Semester</th>
                                        <th>Target for the Second Semester</th>
                                        <th>Physical Target for the Month</th>
                                        <th>Variance</th>
                                        <th>Issues</th>
                                        <th>Remarks</th>
                                        
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                        $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));;    //$sql2 used from search SQL so it can search  
                                        while($row  = mysqli_fetch_array($result)){ ?>
                                            
                                            <tr id="<?php echo $row['id']; ?>"> 
                                                <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['project']; ?>  </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['activity']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['activity_type']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['performance_indicator']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['target_first_sem']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['target_second_sem']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['target_month']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['variance']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['issues']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">  <?php echo $row['remarks']; ?>   </td>


                                                <td style="text-align:center"><a href="reporttemplate.php?edit=<?php echo $row["id"] . "&project=".$row["project"] . "&activity=".$row["activity"] . "&activity_type=" . $row["activity_type"] . "&performance_indicator=".$row["performance_indicator"] ."&datepicker=$year&set=Set"; ?>" class="edit_btn"><i class="fas fa-edit fa-lg"></i></a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        <?php 
                                        }
                                        ?>    
                                </tbody>
                                <form action = "reporttemplate.php" method = "post" class = "form-control searchBox" >
                                    <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto; overflow-x:auto;" value = "<?php echo $search; ?>">
                                    <br>
                                    <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>  <i class="fas fa-search light"> Search</i></button>   </center>
                                </form>

                                <center>
                                    <?php
                                        for ($i=1; $i<=$total_pages; $i++) {                                  
                                            echo '<a class="btn btn-warning" href="reporttemplate.php?page='.$i.'">'.$i.'</a>'; 
                                        }; 
                                    ?>                      
                                </center> <br>
                            </table>
        </div>



    </body>

<!-- Script for year selection -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(function() {
    $('#datepicker').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) {
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(year, 1));
        }
    });

    $("#datepicker").focus(function() {
        $(".ui-datepicker-month").hide();
        $(".ui-datepicker-calendar").hide();
        $(".ui-datepicker-next").hide();
        $(".ui-datepicker-prev").hide();
    });

    });
</script>


<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(picture);
});
</script>

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
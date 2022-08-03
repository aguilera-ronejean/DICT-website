<?php
    require "../../Database/db.php";
    
    //dropdownlist syntax
    $region_sql = "SELECT * FROM region ORDER BY province ASC";
    $region_result = mysqli_query($conn,$region_sql);
    $target_sql = "SELECT * FROM targetsectors ORDER BY TargetSectors ASC";
    $target_result = mysqli_query($conn,$target_sql);
    $ict_sql = "SELECT * FROM ictcompetencyareas ORDER BY ICTCompetencyAreas ASC";
    $ict_result = mysqli_query($conn,$ict_sql);
    $mode_sql = "SELECT * FROM mode ORDER BY Mode ASC";
    $mode_result = mysqli_query($conn,$mode_sql);
    $status_sql = "SELECT * FROM statusremarks ORDER BY StatusRemarks ASC";
    $status_result = mysqli_query($conn,$status_sql);
    $project_sql = "SELECT * FROM projectprogram ORDER BY ProjectProgram ASC";
    $project_result = mysqli_query($conn,$project_sql);
    $category_sql = "SELECT * FROM category ORDER BY Category ASC";
    $category_result = mysqli_query($conn,$category_sql);
    $accesibility_sql = "SELECT * FROM accessibility ORDER BY Accessibility ASC";
    $accesibility_result = mysqli_query($conn,$accesibility_sql);
    $lc3Category_sql = "SELECT * FROM lc3category ORDER BY LC3Category ASC";
    $lc3Category_result = mysqli_query($conn,$lc3Category_sql);

    //sql add
    if(isset($_POST['submit'])){
        $startDate = $_POST['startDate'];
        $eventDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $duration = $_POST['duration'];
        $title = $_POST['title'];
        $lc3Category = $_POST['lc3Category'];
        $accesibility = $_POST['accesibility'];
        $category = $_POST['category']; 
        $project = $_POST['project'];
        $location = $_POST['location'];
        $province = $_POST['province'];
        $details = $_POST['details'];
        $invite = $_POST['invite'];
        $executive = $_POST['executive'];
        $target = $_POST['target'];
        $ict = $_POST['ict'];
        $mode = $_POST['mode'];
        $resource = $_POST['resource'];
        $partner = $_POST['partner'];
        $status = $_POST['status'];

        $add_sql = "INSERT INTO june VALUES(null,'$eventDate','$startDate','$endDate','$startTime','$endTime','$duration',
        '$title','$lc3Category','$accesibility','$category','$project','$location','$province','$details',
        '$invite','$executive','$target','$ict','$mode','$resource','$partner','$status')";
        $add_result = mysqli_query($conn,$add_sql);
        if($add_result){
            echo '<script>alert("Added Successfully!")</script>';
            echo '<script>window.location.href="ReadEvent.php"</script>';
        }
        else{
            echo("Error description: " . mysqli_error($conn));
        }

    }


?>
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Database/db.php";

    $sql_event = "SELECT * FROM event";
    $result_event = mysqli_query($conn,$sql_event);

    if(isset($_GET['submit'])){
        $month = $_GET['eventMonth'];
        $sql = "SELECT * FROM june WHERE Date LIKE '%$month%' AND StatusRemarks = 'Final' AND status = 'approved'";
        $result = mysqli_query($conn,$sql);
    }

    
    

?>


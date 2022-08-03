<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Database/db.php";

    $sql_event3 = "SELECT * FROM event3";
    $result_event3 = mysqli_query($conn,$sql_event3);

    if(isset($_GET['submit'])){
        $month = $_GET['eventMonth'];
        $sql = "SELECT * FROM june WHERE Date LIKE '%$month%' AND StatusRemarks = 'Final' AND status = 'approved'";
        $result = mysqli_query($conn,$sql);
    }
    

?>


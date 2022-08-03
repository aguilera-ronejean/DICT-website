<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Database/db.php";

    $sql_event1 = "SELECT * FROM event2";
    $result_event1 = mysqli_query($conn,$sql_event1);

    if(isset($_GET['submit'])){
        $month = $_GET['eventMonth'];
        $sql = "SELECT * FROM june WHERE Date LIKE '%$month%' AND StatusRemarks = 'Final' AND status = 'approved'";
        $result = mysqli_query($conn,$sql);
    }
    

?>


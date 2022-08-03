<?php
    require "../Database/db.php";
    $project = $_SESSION["project"];

    $sql = "SELECT * FROM june WHERE StatusRemarks = 'Final' AND project = '$project'";
    $result = mysqli_query($conn,$sql);
?>
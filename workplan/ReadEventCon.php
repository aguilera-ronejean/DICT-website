<?php
    require "../Database/db.php";
    $project = $_SESSION["project"];

    $sql = "SELECT * FROM june WHERE project = '$project' AND Status != 'deleted'";
    $result = mysqli_query($conn,$sql);
?>
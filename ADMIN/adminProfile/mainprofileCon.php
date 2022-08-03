<?php
    require "../../Database/db.php";

    $sql = "SELECT * FROM june WHERE StatusRemarks = 'Final'";
    $result = mysqli_query($conn,$sql);
?>
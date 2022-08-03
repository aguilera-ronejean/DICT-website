<?php
    require "../../Database/db.php";

    function approvedCurrentVal($conn,$project2){
        $sql = "SELECT id FROM june WHERE Status = 'approved' AND project = '$project2' AND StatusRemarks = 'Final'";
        $result = mysqli_query($conn,$sql);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $i++;
        }
        return $i;
    }

    function rejectedCurrentVal($conn,$project2){
        $sql = "SELECT id FROM june WHERE Status = 'rejected' AND project = '$project2' AND StatusRemarks = 'Final'";
        $result = mysqli_query($conn,$sql);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $i++;
        }
        return $i;
    }
    function pendingCurrentVal($conn,$project2){
        $sql = "SELECT id FROM june WHERE Status = 'pending' AND project = '$project2' AND StatusRemarks = 'Final'";
        $result = mysqli_query($conn,$sql);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $i++;
        }
        return $i;
    }

    function  totalApproved($conn,$project2){
        $sql = "SELECT id FROM june WHERE project = '$project2' AND StatusRemarks = 'Final' AND  (Status = 'pending' OR Status = 'approved' OR Status = 'rejected')";
        $result = mysqli_query($conn,$sql);
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $i++;
        }
        return $i;
    }


?>
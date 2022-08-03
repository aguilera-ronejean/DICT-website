<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/Database/db.php";

    //if(isset($_POST['submit']) && isset($_POST['event_month']) && isset($_FILES['pic'])){
    if(isset($_POST['submit'])){
        $updateId = $_POST['updateId'];
        $updateMonths = $_POST['updateMonth'];
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));

            $sql_insert = "UPDATE event SET Month = '$updateMonths', Picture = '$imgContent'
            WHERE ID = $updateId";
            $result_insert = mysqli_query($conn, $sql_insert);

            if($result_insert){
                echo '<script>alert("Updated Successfuly!")</script>';
                echo '<script>window.location.href="../homepage.php"</script>';
            }
            else{
                echo("Error description: " . mysqli_error($conn));
                //header('Location: EventCon.php?Failed');
                //exit();
            }
            
        }


      

    }

?>
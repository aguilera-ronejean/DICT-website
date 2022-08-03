<?php
    require "../Database/db.php";
    if(isset($_POST['delete'])){
        $deleteId = $_POST['deleteId'];
        $sql = "DELETE FROM june WHERE id = $deleteId";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<script>alert("Deleted Successfully!")</script>';
            echo '<script>window.location.href="ReadEvent.php"</script>';
        }
        else{
            header("Location: ReadEvent.php?Erro");
            exit();
        }
    }

    


?>
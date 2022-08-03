<?php
include "../../Database/db.php";

$id = 0;
$title = "";
$description = "";
$date = "";
$picture = "";
$link = "";
$display = "";

$edit_state = false;

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    
    if(empty($textbox)){
        return false;
    }
    else{
        return $textbox;
    }
}


if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    updateData();
}

if(isset($_POST['delete'])){
    deleteData();
}

function createData(){
    $id = textboxValue("id");
    $title = textboxValue("title");
    $description = textboxValue("description");
    $date = textboxValue("date");
    $link = textboxValue("link");
    $display = textboxValue("display");
    
    $image = $_FILES['picture']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 
    
    if($title && $description && $date && $title && $link && $image && $display){
        //checks if entered category room exist in database
        $sql = "SELECT
                    *
                FROM
                    highlights
                WHERE
                    title = '$title'
                ";

        $sql2 = "SELECT
                    COUNT(display) AS total
                FROM
                    highlights
                WHERE
                    display = 'Yes'
                ";

        $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']));
        $row = mysqli_fetch_assoc($result2);
        $displayedItems = $row['total'];
        
        if($displayedItems < 3 || $display == 'No'){
            $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

            if(mysqli_num_rows($result) == 0){
                
                $sql = "INSERT INTO `highlights`(`id`, `title`, `description`, `date`, `link`, `picture`, `display`) 
                        VALUES ('','$title','$description','$date','$link','$imgContent','$display')";    

                if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                    
                    ?> 
                    <script> 
                        alert("Highlight has been added succesfully!")
                    </script>              
                    <?php
                    header("Refresh:0; url=highlights.php");
            
                }

            }  
            
            else{
                $error = "Highlight Title Already Exists!";
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
                header("Refresh:0; url=highlights.php");
            }
        }
        else{
            $error = "You have reached the maximum amount to display! Set display to NO to proceed.";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:0; url=highlights.php");
        }
  
            
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=highlights.php");
    }

}

function updateData(){
    $id = textboxValue("id");
    $title = textboxValue("title");
    $description = textboxValue("description");
    $date = textboxValue("date");
    $link = textboxValue("link");
    $display = textboxValue("display");

    $image = $_FILES['picture']['tmp_name']; 

    
      
    if($title && $description && $date && $title && $link && $display){

        $sql = "UPDATE `highlights` 
                SET `title`='$title',`description`='$description',`date`='$date',
                `link`='$link',`display`='$display' 
                WHERE id = '$id'";

        $sql2 = "SELECT
                    *
                FROM
                    highlights
                WHERE
                    title = '$title' AND display = '$display' AND description = '$description'
                ";

        $sql0 = "SELECT
                    COUNT(display) AS total
                FROM
                    highlights
                WHERE
                    display = 'Yes'
                ";

        $result0 = mysqli_query($GLOBALS['conn'], $sql0) or die( mysqli_error($GLOBALS['conn']));
        $row0 = mysqli_fetch_assoc($result0);
        $displayedItems = $row0['total'];
        
        $sql00 = "SELECT
                    description
                FROM
                    highlights
                WHERE
                    id = '$id'
                ";

        $result00 = mysqli_query($GLOBALS['conn'], $sql00) or die( mysqli_error($GLOBALS['conn']));
        $row00 = mysqli_fetch_assoc($result00);
        $setDescription = $row00['description'];

        
               
        if($displayedItems < 3 || $display == 'No' || $setDescription != $description){  

            if(!($image)){ //if no image is uploaded proceed
                $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']));

                if(mysqli_num_rows($result2) == 0){
                    $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                    if($result){
                        ?>
                        <script> 
                            alert("Highlight has been updated succesfully!")
                        </script>              
                        <?php
                        header("Refresh:0; url=highlights.php");
                    }    
                    
                }   
            
                else{
                    $error = "Highlight Title Already Exists!";
                    echo '<script type="text/javascript">alert("'.$error.'");</script>';
                    header("Refresh:0; url=highlights.php");
                }
            }
            else{ //else there is an image uploaded 
                $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                $imgContent = addslashes(file_get_contents($image)); 
                $sql =
                        "UPDATE highlights 
                        SET `picture`='$imgContent'
                        WHERE id= '$id'";

                
                mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn'])); //query to update image in databsae
                header("Refresh:0; url=highlights.php");
            }
        }
        else{
            $error = "You have reached the maximum amount to display! Set display to NO to proceed.";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:0; url=highlights.php");
        }    

    }  
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=highlights.php");
    }        
}

function deleteData(){
    $id = textboxValue("id");
    

    $sql = "DELETE FROM highlights WHERE id = '$id'";
    
    if($id){

    
        if(mysqli_query($GLOBALS['conn'], $sql)){
            
                ?> 
                <script> 
                    alert("Highlight Deleted!")
                </script>              
                <?php
                header("Refresh:0; url=highlights.php");
    
        }
        else{
            ?> 
            <script> 
                alert("Can't Delete Highlight!")
            </script>              
            <?php
            header("Refresh:0; url=highlights.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=highlights.php");
    }    
}

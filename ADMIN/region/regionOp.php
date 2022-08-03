<?php
include "../../Database/db.php";

$id = 0;
$region = "";
$province = "";

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
    $region = textboxValue("region");
    $province = textboxValue("province");
    
    if($region && $province){
        //checks if entered category room exist in database
        $sql = "SELECT
                    *
                FROM
                    region
                WHERE
                    region = '$region' AND  province = '$province'
                ";
        

        $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));
        
  
        if(mysqli_num_rows($result) == 0){
            
            $sql = "insert into region(id, region, province) 
            values('','$region', '$province')";    

            if(mysqli_query($GLOBALS['conn'], $sql)or die( mysqli_error($GLOBALS['conn']))){
                
                ?> 
                <script> 
                    alert("Region has been added succesfully!")
                </script>              
                <?php
                header("Refresh:0; url=region.php");
        
            }

        }  
          
        else{
            $error = "Region Already Exists!";
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
            header("Refresh:0; url=region.php");
        }
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=region.php");
    }

}

function updateData(){
    $id = textboxValue("id");
    $region = textboxValue("region");
    $province = textboxValue("province");
      
    if($region){
        
        $sql = "UPDATE region 
                SET region = '$region', province = '$province'
                WHERE id= '$id'";

        $sql2 = "SELECT region 
                FROM region 
                WHERE region = '$region' AND province = '$province'";

        $result2 = mysqli_query($GLOBALS['conn'], $sql2) or die( mysqli_error($GLOBALS['conn']));
            

            if(mysqli_num_rows($result2) == 0){
                $result = mysqli_query($GLOBALS['conn'], $sql) or die( mysqli_error($GLOBALS['conn']));

                if($result){
                    ?>
                    <script> 
                        alert("Region has been updated succesfully!")
                    </script>              
                    <?php
                    header("Refresh:0; url=region.php");
                }    
                
            }   
        
            else{
                $error = "Region Already Exists!";
                echo '<script type="text/javascript">alert("'.$error.'");</script>';
                header("Refresh:0; url=region.php");
            }
            

    }  

    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=region.php");
    }        
}

function deleteData(){
    $id = textboxValue("id");
    $region = textboxValue("region");

    $sql = "DELETE FROM region WHERE id = '$id'";
    
    if($id && $region){

        
        

            if(mysqli_query($GLOBALS['conn'], $sql)){

                
                
                    ?> 
                    <script> 
                        alert("Region Deleted!")
                    </script>              
                    <?php
                    header("Refresh:0; url=region.php");
            }
            else{
                ?> 
                <script> 
                    alert("Can't Delete Region!")
                </script>              
                <?php
                header("Refresh:0; url=region.php");
            }
        
        
    }
    else{
        ?> 
        <script> 
            alert("Fields can't be empty!")
        </script>              
        <?php
        header("Refresh:0; url=Region.php");
    }    
}

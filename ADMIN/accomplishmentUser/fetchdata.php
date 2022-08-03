<?php

include "../../Database/db.php";
//fetchdata.php
if(isset($_POST["action"]))
{
 $output = '';
 if($_POST["action"] == "region")
 {
  $query = "SELECT province FROM region WHERE region = '".$_POST["query"]."' GROUP BY province";
  $result = mysqli_query($conn, $query);
  $output .= '<option value=""> </option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["province"].'">'.$row["province"].'</option>';
  }
 }

 else if($_POST["action"] == "project")
 {
  $query = "SELECT activity FROM report WHERE activity_type = 'training' AND project = '".$_POST["query"]."'";
  $result = mysqli_query($conn, $query);
  $output .= '<option value=""> </option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["activity"].'">'.$row["activity"].'</option>';
  }
 }

 echo $output;
}
?>

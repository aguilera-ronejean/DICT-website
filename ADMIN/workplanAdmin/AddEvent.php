<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
?>


<?php
    require "AddEventCon.php";
?>

<html>
    <?php include '../header/header.php';?>
    <style>
    <?php include 'header/mobile1.css';?> 
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <link rel="stylesheet" href="AddEvent.css">

    
    <form class="form1" action = "" method = "post">
        <p>Title: <textarea name = "title" rows = "4" cols = "30" maxlength="255"></textarea></p>
        <p>Start Date: <input type = "date" name = "startDate" ></p>
        <p>End Date: <input type = "date" name = "endDate"></p>
        <p>Start Time: <input type = "time" name = "startTime" class="startTime"></p>
        <p>End Time: <input type = "time" name = "endTime" class="endTime"></p>
        <p>Duration: <input type = "number" name = "duration" class="duration" step="0.1"></p>
        <p>Location: <input type = "text" name = "location" class="location"></p>
        <p>Other Details: <input type = "text" name = "details" class="details"></p>
        <p>Resource Person/Unit: <input type = "text" name = "resource" class="resource"></p>
        <p>Partner Institution: <input type = "text" name = "partner" class="partner"></p>
        <p>Invite Executive/s (Check if YES): 
            <label for = "invite">YES</label>
            <input type = "radio" name = "invite" value = "TRUE" id = "invite1">
            <label for = "invite2">NO</label>
            <input type = "radio" name = "invite" value = "FALSE" id = "invite2">
            <input type = "radio" name = "invite" value = "" id = "invite3" checked>
        </p>
        <p>Invited Executive/s: <input type = "text" name = "executive" class="executive"></p>
        <p><label for = "lc3Category">LC3 Category:</label>
        <select name = "lc3Category" class="lc3Cat">
            <?php while($row = mysqli_fetch_assoc($lc3Category_result)) {?>
                <option value = "<?php echo $row['LC3Category']?>"><?php echo $row['LC3Category']?></option>
            <?php }?>
        </select></p>
        <p><label for = "accesibility">Accesiblity:</label>
        <select name = "accesibility" class="access">
            <?php while($row = mysqli_fetch_assoc($accesibility_result)){?>
                <option value = "<?php echo $row['Accessibility']?>"><?php echo $row['Accessibility']?></option>
            <?php }?>      
        </select></p>
        <p><label for = "category">Category:</label>
        <select name = "category" class="cat">
            <?php while($row = mysqli_fetch_assoc($category_result)){?>
                <option value = "<?php echo $row['Category']?>"><?php echo $row['Category']?></option>
            <?php }?>
        </select></p>
        <p><label for = "project">Project/Program:</label>
        <select name = "project" class="proj">
            <?php while($row = mysqli_fetch_assoc($project_result)){?>
                <option value = "<?php echo $row['ProjectProgram']?>"><?php echo $row['ProjectProgram']?></option>
            <?php }?>
        </select></p>
        
        <p><label for = "province">Province:</label>
        <select name = "province" class="prov">
            <?php while($result = mysqli_fetch_assoc($region_result)) {?>
                <option value = "<?php echo $result['province']?>"><?php echo $result['province']?></option>
            <?php }?>
        </select></p>
        <p><label for = "target">Target Sectors:</label>
        <select name = "target" class="tar">
            <?php while($row = mysqli_fetch_assoc($target_result)){?>
                <option value = "<?php echo $row['TargetSectors']?>"><?php echo $row['TargetSectors']?></option>
            <?php }?>
        </select></p>
        <p><label for = "ict">ICT Competency Areas:</label>
        <select name = "ict" class="ict">
            <?php while($row = mysqli_fetch_assoc($ict_result)){?>
                <option value = "<?php echo $row['ICTCompetencyAreas']?>"><?php echo $row['ICTCompetencyAreas']?></option>
            <?php }?>
        </select></p>
        <p><label for = "mode">Mode:</label>
        <select name = "mode" class="mod">
            <?php while($row = mysqli_fetch_assoc($mode_result)){?>
                <option value = "<?php echo $row['Mode']?>"><?php echo $row['Mode']?></option>
            <?php }?>
        </select></p>
       
        <p><label for = "status">Status/Remarks:</label>
        <select name = "status" class="stat">
            <?php while($row = mysqli_fetch_assoc($status_result)){?>
                <option value = "<?php echo $row['StatusRemarks']?>"><?php echo $row['StatusRemarks']?></option>
            <?php } ?>
        </select></p>
        <input type = 'submit' name = 'submit' value = 'Add'>
        <a href = 'ReadEvent.php'><input type = "submit_1" value = "Cancel"></a> 
    </form>

<footer>
            <?php include 'header/footer.html';?>
        <style>
            <?php include 'header/footer.css';?> 
        </style>
</footer>



</html>
<?php
// Initialize the session
session_start();
$projectACS = $_SESSION["project"];
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
?>


<?php
    require "../../Database/db.php";
    require "AddEventCon.php";

    if(isset($_GET['edit'])){
        $editId = $_GET['editId'];
        $editStartDate = $_GET['editStartDate'];
        $editEndDate = $_GET['editEndDate'];
        $editStartTime = $_GET['editStartTime'];
        $editEndTime = $_GET['editEndTime'];
        $editDuration = $_GET['editDuration'];
        $editTitle = $_GET['editTitle'];
        $editLC3Category = $_GET['editLC3Category'];
        $editAccesiblity = $_GET['editAccesiblity'];
        $editCategory = $_GET['editCategory'];
        $editProjectProgram = $_GET['editProjectProgram'];
        $editLocation = $_GET['editLocation'];
        $editProvince = $_GET['editProvince'];
        $editOtherDetails = $_GET['editOtherDetails'];
        $editInviteExecutives = $_GET['editInviteExecutives'];
        $editInvitedExecutives = $_GET['editInvitedExecutives'];
        $editTargetSector = $_GET['editTargetSector'];
        $editIctCompetencyAreas = $_GET['editIctCompetencyAreas'];
        $editMode = $_GET['editMode'];
        $editResourcePersonUnit = $_GET['editResourcePersonUnit'];
        $editPartnerInstitution = $_GET['editPartnerInstitution'];
        $editStatusRemarks = $_GET['editStatusRemarks'];
    }

    if(isset($_POST['update'])){
        $updateId = $_POST['updateId'];
        $updateStartDate = $_POST['updateStartDate'];
        $updateEndDate = $_POST['updateEndDate'];
        $updateStartTime = $_POST['updateStartTime'];
        $updateEndTime = $_POST['updateEndTime'];
        $updateDuration = $_POST['updateDuration'];
        $updateTitle = $_POST['updateTitle'];
        $updateLC3Category = $_POST['updateLC3Category'];
        $updateAccesiblity = $_POST['updateAccesiblity'];
        $updateCategory = $_POST['updateCategory'];
        $updateProjectProgram = $_POST['updateProjectProgram'];
        $updateLocation = $_POST['updateLocation'];
        $updateProvince = $_POST['updateProvince'];
        $updateOtherDetails = $_POST['updateOtherDetails'];
        $updateInviteExecutives = $_POST['updateInviteExecutives'];
        $updateInvitedExecutives = $_POST['updateInvitedExecutives'];
        $updateTargetSector = $_POST['updateTargetSector'];
        $updateIctCompetencyAreas = $_POST['updateIctCompetencyAreas'];
        $updateMode = $_POST['updateMode'];
        $updateResourcePersonUnit = $_POST['updateResourcePersonUnit'];
        $updatePartnerInstitution = $_POST['updatePartnerInstitution'];
        $updateStatusRemarks = $_POST['updateStatusRemarks'];



        $update_sql = "UPDATE june SET StartDate = '$updateStartDate', EndDate = '$updateEndDate',  
        StartTime = '$updateStartTime', EndTime = '$updateEndTime', Duration = '$updateDuration',
        Title = '$updateTitle', LC3Category = '$updateLC3Category', Accesiblity = '$updateAccesiblity',
        Category = '$updateCategory', ProjectProgram = '$updateProjectProgram', Location = '$updateLocation',
        Province = '$updateProvince', OtherDetails = '$updateOtherDetails', 
        InviteExecutives = '$updateInviteExecutives', InvitedExecutives = '$updateInvitedExecutives', 
        TargetSector = '$updateTargetSector', IctCompetencyAreas = '$updateIctCompetencyAreas', 
        Mode = '$updateMode', ResourcePersonUnit = '$updateResourcePersonUnit',
        PartnerInstitution = '$updatePartnerInstitution', StatusRemarks = '$updateStatusRemarks' 
        WHERE id = $updateId";

        $update_result = (mysqli_query($conn,$update_sql) or die(mysqli_error($conn)));

        if($update_result == TRUE){
            echo '<script>alert("Successfuly Update!")</script>';
            echo '<script>window.location.href="ReadEvent.php"</script>';
        }
        else{
            header("Location: UpdateEvent.php?Failed");
            exit();
        }  

    }
?>

    
    
<html>
    <?php include '../header/header.php';?>
    <style>
    <?php include 'header/mobile1.css';?> 
    </style>
<title>Update</title>

    <link rel = "stylesheet" href = 'AddEvent.css'>
    <form class="form1" action = "UpdateEvent.php" method = "post">



        
        <?php 
            $sql = "SELECT * FROM june";
            $result = mysqli_query($conn,$sql);
        ?>
        <?php while($row = mysqli_fetch_assoc($result)) {?>
            <?php if($row['id'] == $editId){ ?>
                <p>Title: <textarea name = "updateTitle" rows = "4" cols = "30" maxlength="255" value = "<?php echo $editTitle ?>" ><?php echo $row['Title'] ?></textarea></p>
            <?php }?>
        <?php }?>

        <p>Start Date: <input type = "date" name = "updateStartDate" value = "<?php echo $editStartDate ?>"></p>
        <p>End Date: <input type = "date" name = "updateEndDate" value = "<?php echo $editEndDate ?>"></p>
        <p>Start Time: <input class="startTime" type = "time" name = "updateStartTime"  value = "<?php echo $editStartTime ?? ""?>"></p>
        <p>End Time: <input class="endTime" type = "time" name = "updateEndTime" value = "<?php echo $editEndTime ?? "" ?>"></p>
        <p>Duration: <input class="duration" type = "number" name = "updateDuration" step="0.1" value = "<?php echo $editDuration ?>"></p>
        
        <p>Location: <input class="location" type = "text" name = "updateLocation" value = "<?php echo $editLocation ?? ""?>"></p>
        
        <p>Other Details: <input class="details" type = "text" name = "updateOtherDetails" value = "<?php echo $editOtherDetails ?? ""?>"></p>
        <p>Resource Person/Unit: <input class="resource" type = "text" name = "updateResourcePersonUnit" value = "<?php echo $editResourcePersonUnit ?? ""?>"></p>
        <p>Partner Institution: <input class="partner" type = "text" name = "updatePartnerInstitution" value = "<?php echo $editPartnerInstitution ?? ""?>"></p>
        <p>Invite Executive/s (Check if YES): 
            <?php if($editInviteExecutives === "TRUE"){?>
                <label for = "invite1">YES</label>
                <input type = "radio" name = "updateInviteExecutives" value = "TRUE" id = "invite1" checked = "checked">
                <label for = "invite2">NO</label>
                <input type = "radio" name = "updateInviteExecutives" value = "FALSE" id = "invite2">
            <?php }?>
            <?php if($editInviteExecutives === "FALSE"){?>
                <label for = "invite1">YES</label>
                <input type = "radio" name = "updateInviteExecutives" value = "TRUE" id = "invite1">
                <label for = "invite2">NO</label>
                <input type = "radio" name = "updateInviteExecutives" value = "FALSE" id = "invite2"  checked = "checked">
            <?php }?>
            <?php if($editInviteExecutives === ""){?>
                <label for = "invite1">YES</label>
                <input type = "radio" name = "updateInviteExecutives" value = "TRUE" id = "invite1">
                <label for = "invite2">NO</label>
                <input type = "radio" name = "updateInviteExecutives" value = "FALSE" id = "invite2">
                <input type = "radio" name = "updateInviteExecutives" value = "" id = "invite3" checked = "checked">
            <?php }?>   
        </p>
        <p>Invited Executive/s: <input class="executive" type = "text" name = "updateInvitedExecutives" value = "<?php echo $editInvitedExecutives ?? ""?>"></p>

        <p><label for = "updateLC3Category">LC3 Category:</label>
        <select class="lc3Cat" name = "updateLC3Category">
                <option value = "<?php echo $editLC3Category ?>"><?php echo $editLC3Category ?></option>
                <?php while($row = mysqli_fetch_assoc($lc3Category_result)) {?>
                <option value = "<?php echo $row['LC3Category']?>"><?php echo $row['LC3Category']?></option>
            <?php }?>
        </select></p>
        <p><label for = "updateAccesiblity">Accesiblity:</label>
        <select class="access" name = "updateAccesiblity">
                <option value = "<?php echo $editAccesiblity?>"><?php echo $editAccesiblity?></option>
                <?php while($row = mysqli_fetch_assoc($accesibility_result)){?>
                <option value = "<?php echo $row['Accessibility']?>"><?php echo $row['Accessibility']?></option>
            <?php }?>      
        </select></p>
        <p><label for = "updateCategory">Category:</label>
        <select class="cat" name = "updateCategory">
            <option value = "<?php echo $editCategory?>"><?php echo $editCategory?></option>
            <?php while($row = mysqli_fetch_assoc($category_result)){?>
                <option value = "<?php echo $row['Category']?>"><?php echo $row['Category']?></option>
            <?php }?>
        </select></p>

        <p><label for = "updateProjectProgram">Project/Program:</label>
            <input type = "text" name = "updateProjectProgram" class = "proj" value = "<?php echo $editProjectProgram?>" readonly onclick="this.blur";>
        </p>


        <p><label for = "updateProvince">Province:</label>
        <select class="prov" name = "updateProvince">
            <option value = "<?php echo $editProvince?>"><?php echo $editProvince?></option>
            <?php while($result = mysqli_fetch_assoc($region_result)) {?>
                <option value = "<?php echo $result['province']?>"><?php echo $result['province']?></option>
            <?php }?>
        </select></p>
        
        <p><label for = "updateTargetSector">Target Sectors:</label>
        <select class="tar" name = "updateTargetSector">
            <option value = "<?php echo $editTargetSector?>"><?php echo $editTargetSector?></option>
            <?php while($row = mysqli_fetch_assoc($target_result)){?>
                <option value = "<?php echo $row['TargetSectors']?>"><?php echo $row['TargetSectors']?></option>
            <?php }?>
        </select></p>
        <p><label for = "updateIctCompetencyAreas">ICT Competency Areas:</label>
        <select class="ict" name = "updateIctCompetencyAreas">
            <option value = "<?php echo $editIctCompetencyAreas?>"><?php echo $editIctCompetencyAreas?></option>
            <?php while($row = mysqli_fetch_assoc($ict_result)){?>
                <option value = "<?php echo $row['ICTCompetencyAreas']?>"><?php echo $row['ICTCompetencyAreas']?></option>
            <?php }?>
        </select></p>
        <p><label for = "updateMode">Mode:</label>
        <select class="mod" name = "updateMode">
            <option value = "<?php echo $editMode?>"><?php echo $editMode?></option>
            <?php while($row = mysqli_fetch_assoc($mode_result)){?>
                <option value = "<?php echo $row['Mode']?>"><?php echo $row['Mode']?></option>
            <?php }?>
        </select></p>
        
        <p><label for = "updateStatusRemarks">Status/Remarks:</label>
        <select class="stat" name = "updateStatusRemarks">
            <option value = "<?php echo $editStatusRemarks?>"><?php echo $editStatusRemarks?></option>
            <?php while($row = mysqli_fetch_assoc($status_result)){?>
                <option value = "<?php echo $row['StatusRemarks']?>"><?php echo $row['StatusRemarks']?></option>
            <?php } ?>
        </select></p>
        <input type = 'submit' name = 'update' value = 'Update'>
        <input type = "hidden" name = "updateId" value = "<?php echo $editId ?? "" ?>">
        <a href = 'ReadEvent.php'><input type = "submit_1" name = "cancel" value = "Cancel"></a>

    </form>
    



    <footer>
            <?php include 'header/footer.html';?>
        <style>
            <?php include 'header/footer.css';?> 
        </style>
    </footer>




</html>
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
    require "ReadEventCon.php";
    require "DeleteEvent.php";
?>

<html>
    <head>
            <?php include '../header/header.php';?>
           
        <link rel="stylesheet" href="ReadEvent1.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>WorkplanAdmin</title>    
    </head>

    <body>
    

    <div class = "tables" style="margin-bottom: 35%; margin-top: 10%;">
        
    <h3>WORKPLAN</h3>
    <form action = 'AddEvent.php' method = 'post'>
        <input type = 'submit' name = 'add' value = 'Create' id = 'create'>
    </form>
    <style>
        #create{
            display: none;
        }
    </style>
    <br>
    <table id="table" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Project/Program</th>
                <th>LC3 Category</th>
                <th>Mode</th>
                <th>Status/Remarks</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Duration</th>
                <th>Accesiblity</th>
                <th>Category</th>
                <th>Location</th>
                <th>Province</th>
                <th>Other Details</th>
                <th>Invite Executive/s (Check if YES)</th>
                <th>Invited Executive/s</th>
                <th>Target Sectors</th>
                <th>ICT Competency Areas</th>
                <th>Resource Person/Unit</th>
                <th>Partner Institution</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                    <td><?php echo $row['Date']?></td>
                    <td><?php echo $row['ProjectProgram']?></td>
                    <td><?php echo $row['LC3Category']?></td>
                    <td><?php echo $row['Mode']?></td>
                    <td><?php echo $row['StatusRemarks']?></td>
                    <td><?php echo $row['Title']?></td>
                    <td><?php echo $row['StartDate']?></td>
                    <td><?php echo $row['EndDate']?></td>
                    <td><?php echo $row['StartTime']?></td>
                    <td><?php echo $row['EndTime']?></td>
                    <td><?php echo $row['Duration']?></td>
                    <td><?php echo $row['Accesiblity']?></td>
                    <td><?php echo $row['Category']?></td>
                    <td><?php echo $row['Location']?></td>
                    <td><?php echo $row['Province']?></td>
                    <td><?php echo $row['OtherDetails']?></td>
                    <td><?php echo $row['InviteExecutives']?></td>
                    <td><?php echo $row['InvitedExecutives']?></td>
                    <td><?php echo $row['TargetSector']?></td>
                    <td><?php echo $row['IctCompetencyAreas']?></td>
                    <td><?php echo $row['ResourcePersonUnit']?></td>
                    <td><?php echo $row['PartnerInstitution']?></td>
                   
                    <td>
                        <form action = "" method = "post">
                            <input type = "submit" name = "delete" value = "Delete" id = "delete" onclick="return confirm('Are you sure to Delete this data?');">
                            <input type = "hidden" name = "deleteId" value = "<?php echo $row['id']?>">
                        </form>
<br>
                       <form action = "UpdateEvent.php" method = "get"> 
                            <input type = "submit" name = "edit" value = "Edit" id = "edit">
                            <input type = "hidden" name = "editId" value = "<?php echo $row['id']?>">
                            <input type = "hidden" name = "editStartDate" value = "<?php echo $row['StartDate']?>">
                            <input type = "hidden" name = "editEndDate" value = "<?php echo $row['EndDate']?>">
                            <input type = "hidden" name = "editStartTime" value = "<?php echo $row['StartTime']?>">
                            <input type = "hidden" name = "editEndTime" value = "<?php echo $row['EndTime']?>">
                            <input type = "hidden" name = "editDuration" value = "<?php echo $row['Duration']?>">
                            <input type = "hidden" name = "editTitle" value = "<?php echo $row['Title']?>">
                            <input type = "hidden" name = "editLC3Category" value = "<?php echo $row['LC3Category']?>">
                            <input type = "hidden" name = "editAccesiblity" value = "<?php echo $row['Accesiblity']?>">
                            <input type = "hidden" name = "editCategory" value = "<?php echo $row['Category']?>">
                            <input type = "hidden" name = "editProjectProgram" value = "<?php echo $row['ProjectProgram']?>">
                            <input type = "hidden" name = "editLocation" value = "<?php echo $row['Location']?>">
                            <input type = "hidden" name = "editProvince" value = "<?php echo $row['Province']?>">
                            <input type = "hidden" name = "editOtherDetails" value = "<?php echo $row['OtherDetails']?>">
                            <input type = "hidden" name = "editInviteExecutives" value = "<?php echo $row['InviteExecutives']?>">
                            <input type = "hidden" name = "editInvitedExecutives" value = "<?php echo $row['InvitedExecutives']?>">
                            <input type = "hidden" name = "editTargetSector" value = "<?php echo $row['TargetSector']?>">
                            <input type = "hidden" name = "editIctCompetencyAreas" value = "<?php echo $row['IctCompetencyAreas']?>">
                            <input type = "hidden" name = "editMode" value = "<?php echo $row['Mode']?>">
                            <input type = "hidden" name = "editResourcePersonUnit" value = "<?php echo $row['ResourcePersonUnit']?>">
                            <input type = "hidden" name = "editPartnerInstitution" value = "<?php echo $row['PartnerInstitution']?>">
                            <input type = "hidden" name = "editStatusRemarks" value = "<?php echo $row['StatusRemarks']?>">
                        </form>
                    </td>
                    
            </tr>
            <?php }?>
        </tbody>
    </table>
    </div>

    

    </body>
        <footer>
            <?php include 'header/footerWorkplan.html';?>
        <style>
            <?php include 'header/footerWorkplan1.css';?> 
        </style>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src ="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src ="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src ="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#table').DataTable( {
    	            responsive: true
                } );
            } );
        </script>
    </footer>

                
    

</html>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../public homepage/homepage.php");
    exit;
}
?>


<?php
    require "StatusCon.php";
    include "../header/header.php";
    
?>

<html>
    <head>
                
        <link rel="stylesheet" href="status4.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
    

    <div class = "tables" style="margin-bottom: 30%; margin-top: 12%;">
        
    
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
            <?php $status = ""; ?>
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
                        <div class = "hide_buttons">
                            <form action = "StatusCon.php" method = "post">
                                <input type = "submit" name = "admin_approve" value = "Approve" id = "approve">
                                <input type = "hidden" name = "editId" value = "<?php echo $row['id']?>">
                                <input type = "hidden" name = "editStatus" value = "<?php echo $row['Status']?>">
                            </form>
                            
                            <form action = "StatusCon.php" method = "post">
                                <input type = "hidden" name = "editId" value = "<?php echo $row['id']?>">
                                <input type = "hidden" name = "editStatus" value = "<?php echo $row['Status']?>">
                                <input type = "submit" name = "admin_reject" value = "Reject" id = "reject">
                            </form>
                            <form action = "StatusCon.php" method = "post">
                                <input type = "hidden" name = "editId" value = "<?php echo $row['id']?>">
                                <input type = "hidden" name = "editStatus" value = "<?php echo $row['Status']?>">
                                <input type = "submit" name = "admin_pending" value = "Pending" id = "pending">
                            </form>
                            <form action = "StatusCon.php" method = "post">
                                <input type = "hidden" name = "editId" value = "<?php echo $row['id']?>">
                                <input type = "hidden" name = "editStatus" value = "<?php echo $row['Status']?>">
                                <input type = "submit" name = "admin_delete" value = "Delete" id = "delete" onclick="return confirm('Are you sure to Delete this data?');">
                            </form>   
                            
                        </div>                 
    <br>
                    
                    </td>    
            </tr>
            
            <?php
                $status = $row['Status'];
                
            ?>
            <?php }?>
        </tbody>
    </table>
    <a href = "dashboard.php"><input type = "button" name = "back" value = "Back"></a> 
    </div>
    
    <?php if($status != null){?>
        <?php if($status === 'approved'){?>
            <style>
                #approve, #delete, #reject{
                    display: none;
                }
            </style>
        <?php }?>
        <?php if($status === 'pending'){?>
            <style>
                #delete, #pending{
                    display: none;
                }
            </style>
        <?php }?>
        <?php if($status === 'rejected'){?>
            <style>
                #reject, #approve{
                    display: none;
                }
            </style>
        <?php }?>
    <?php }?>
    
    

    </body>
        
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

    
             <?php include '../header/footer.html';?>
            <style>
                <?php include '../header/footer.css';?> 
            </style>
    
</html>
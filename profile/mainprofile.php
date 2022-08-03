<?php
// Initialize the session
session_start();


 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
?>


<?php
    require "mainprofileCon.php";
?>

<html>
    <head>
    <section class="header">
        <nav>
            <a href="#"><img src="images/DICT.png"></a>
            
            <div class="nav-links" id="navLinks">
            
            <i class="fa fa-bars" onclick="hideMenu()"></i>
            
            
                <ul>
                    <li><a href="../dashboard/homepage/home.php">HOME</a></li>
                    </li>
                    <li><a href="#">ACCOMPLISHMENT</a>
                    <ul>
                        <li><a href="../ADMIN/accomplishmentGeneralUser/acc_General_User.php">General Accomplishments</a></li>
                        <li><a href="../ADMIN/accomplishmentUser/acc_User.php">Training Accomplishments</a></li>
                    </ul></li>
                    <li><a href="#">TASKS</a>
                        <ul>
                            <li><a href="../workplan/ReadEvent.php">WORKPLAN</a></li>
                            <li><a href="../ADMIN/reportgeneration/reportgeneration.php">REPORT ANALYTICS</a></li>
                        </ul>
                    </li>
                    <li><a href="#">ACCOUNT</a>
                        <ul>
                            <li><a href="mainprofile.php">PROFILE</a></li>
                            <li><a href="../login/logout.php">LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <i class="fa fa-bars" style="margin-top: -40px;" onclick="showMenu()"></i>
        </nav>
    </section>
                
        <link rel="stylesheet" href="css/mainprofile1.css">
        <link rel="stylesheet" href="css/headerMain.css">
        <link rel="stylesheet" href="css/mobileMain1.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    </head>

    <body>
    
                <?php include 'generalinfo.php';?>
            <style>
                <?php include 'css/pageMain.css';?> 
            </style>

    <br><br><br>
    <div class = "tables" style="width:80%; margin: auto;" >
        
    <h3>EVENT CALENDAR</h3>
    <table id="table" class="display responsive nowrap">
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
            </tr>
            <?php }?>
        </tbody>
    </table>
    </div>

    

    </body>
    <footer>
            <?php include 'footerMain.html';?>
        <style>
            <?php include 'css/footerMain.css';?> 
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
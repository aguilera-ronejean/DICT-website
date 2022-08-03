<?php
    require "ReadEventCon2.php";
    
?>

<html>
    <head>
        <title>Upcoming Activities</title>
        <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="ReadEvent.css">
        <link rel="stylesheet" href="../css/publicHeader.css">
    </head>

    <body>
    
     <nav>
            <a href="../home.php"><center><img src="../images/DICT.png"></center></a>
            
            <div class="nav-links" id="navLinks">
            
            <i class="fa fa-bars" onclick="hideMenu()">
            
            </i>
    
                
            
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
            
        </nav>           
            


    <div class = "tables">
        
    <?php while($row2 = mysqli_fetch_assoc($result_event1)){?>
    <h3>
        <?php 
			$month = $row2['Month'];
			$arrMonth = explode('-',$month);
			$eventMonth = $arrMonth[1];
			$eventMonthArr = array('01' => 'January', '02' => 'February','03' => 'March', '04' => 'April', 
			'05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September',
			'10' => 'October', '11' => 'November', '12' => 'December');
            echo "Upcoming Activities for the Month of ".$eventMonthArr[$eventMonth];
		?>
    </h3>
    <?php }?>
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
    <?php
        if(isset($_POST['submit'])){
            $editMonth = $_POST['eventMonth'];
            $editId = $_POST['id'];
        }
    
    ?>
    <form action = "EventCon2.php" method = "post" enctype="multipart/form-data">
        <div class = "hide_button">
            <p>MONTH:<input type = 'month' name = 'updateMonth' value="<?php echo $editMonth?>"></p>
            <p>PICTURE:<input type = 'file' name = 'image'></p>
            <input type = 'hidden' name = 'updateId' value = "<?php echo $editId?>">
            <input type = 'submit' name = 'submit' value = 'Submit'>
        </div>
        <a href="../home.php"><input type="button" value="Cancel"></a>
    </form>
    </div>

    </body>


    <footer>
            
        
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
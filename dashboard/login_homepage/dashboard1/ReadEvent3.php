<?php
    require "ReadEventCon3.php";
    session_start();
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $status = $_SESSION["status"];
    $region = $_SESSION["region"];
    $province = $_SESSION["province"];
    $project = $_SESSION["project"];

    
    
?>

<html>
    <head>
              
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="ReadEvent.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>

    <body>
    
    <nav>
            <a href="../../homepage.php"><img src="../images/DICT.png"></a>
            
            <div class="nav-links" id="navLinks">
            
            <i class="fa fa-bars" onclick="hideMenu()">
            
            </i>
                
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
            
        </nav>

    <div class = "tables">
        
    <?php while($row2 = mysqli_fetch_assoc($result_event3)){?>
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
        if(isset($_GET['submit'])){
            $editMonth = $_GET['eventMonth'];
            $editId = $_GET['id'];
        }
    
    ?>
    <form action = "EventCon3.php" method = "post" enctype="multipart/form-data">
        <div class = 'hide_buttons'>
            <p>MONTH:<input type = 'month' name = 'updateMonth' value="<?php echo $editMonth?>"></p>
            <p>PICTURE:<input type = 'file' name = 'image'></p>
            <input type = 'hidden' name = 'updateId' value = "<?php echo $editId?>">
            <input type = 'submit' name = 'submit' value = 'Submit'>
        </div>
        <a href="../../homepage.php"><input type="button" value="Cancel"></a>
    </form>
    </div>

        <?php
            
            if($newProject != 'MISS'){
        ?>
            <style>
                .hide_buttons{
                    display: none;
                }
            </style>
        <?php } ?>


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
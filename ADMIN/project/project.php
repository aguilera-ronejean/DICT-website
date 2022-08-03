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

include "../../Database/db.php";
include "../header/header.php";
include "projectOp.php";



if (isset($_GET['edit'])) {     // puts selected row into textbox for it to be editted/deleted
    $id = $_GET['edit'];
    $edit_state = true;
    
    $sql = "SELECT * FROM project WHERE id = '$id'";
    $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    
    $id = $row['id'];
    $project = $row['project'];
    
}

if(isset($_POST['btn-search'])){    //serach buttons function
    $search = $_POST['search'];

    
    if($search != ''){

            $sql2 = "SELECT * FROM project WHERE id LIKE '%$search%' OR project LIKE '%$search%'";
            $result2 = mysqli_query($GLOBALS['conn'], $sql2);

            if(mysqli_num_rows($result2) == 0){

                ?> 
                <script> 
                    alert("No Data Found!")
                </script>              
                <?php

                $sql2 = "SELECT * FROM project";
                $search = "";
            }
    
    }
    else{
        $sql2 = "SELECT * FROM project";
        $search = "";
    }
}
else{
    
    $sql2 = 'SELECT * FROM project';
    $search = "";
}
?>

<html>
    <head>
    <link rel="stylesheet" href="project1.css" type="text/css">
    <title>Project</title>
    </head>
    <body>
        <main>

            <section>
                <div class="container">
                    <form method="post" action="projectOp.php"> 
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <label for="id" class="form-label">User ID</label>
                                        <input type="text" id = "id" name = "id" class="form-control" placeholder = "Auto Generated ID" value="<?php echo $id; ?>" readonly >
                                    </div>
                                    <div class="col">
                                        <label for="project" class="form-label">Project Name</label>
                                        <input type="text" id = "project" name = "project" class="form-control" value="<?php echo $project; ?>" required >
                                    </div>
                                </div> 
                                <div class="row align-items-center mt-2">
                                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                                            <button dat-toggle='tooltip' class="btn btn-primary" name = "create" id = "btn-create">Add</button>
                                            <button dat-toggle='tooltip' class="btn btn-warning"name = "update" id = "btn-update">Update</button>
                                            <button dat-toggle='tooltip' class="btn btn-danger"name = "delete" id = "btn-delete" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <div class="panel-body mt-5">
            <form action = "project.php" method = "post" class = "form-control searchBox" >
                <input type = "text" autocomplete="on" placeholder="Search Values Here" class = "form-control mt-3" name = "search" id = "search" style = "width:80%; margin: auto;" value = "<?php echo $search; ?>">
                <br>
                <center><button width="200" name = "btn-search" dat-toggle='tooltip' data-placement = 'bottom' title = 'Search' class = "btns btn-success" id = "btn-search" hidden>   <i class="fas fa-search light"> Search</i></button>   </center>
            </form>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>Project</th>         
                                        <th class="text-center" style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                    
                                        $result  = mysqli_query($conn , $sql2) or die( mysqli_error($conn));;    //$sql2 used from search SQL so it can search    
                                        while($row  = mysqli_fetch_array($result)){ ?>
                                            
                                            <tr id="<?php echo $row['id']; ?>"> 
                                                <td style="text-align:center" data-id = "<?php echo $row['id']; ?>">    <?php echo $row['id']; ?>   </td>
                                                <td data-id = "<?php echo $row['id']; ?>">    <?php echo $row['project']; ?>     </td>
                                                
                                                <td style="text-align:center"><a href="project.php?edit=<?php echo $row["id"]; ?>" class="edit_btn"><i class="fas fa-edit fa-lg"></i></a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        <?php 
                                        }
                                        ?>    
                                </tbody>
                            </table>
        </div>



    </body>

    

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

                <?php include '../header/footer.html';?>
            <style>
                <?php include '../header/footer.css';?> 
            </style>

</html>